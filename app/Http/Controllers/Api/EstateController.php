<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Image;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function index()
    {
        //
    }

    public function show(string $id)
    {
        $estate = Estate::where('id', $id)->with('images')->with('services')->first();
        if (!$estate) return response(null, 404);

        $prevEstate = Estate::where('id', '<', $id)->orderBy('id', 'DESC')->first();
        if (!$prevEstate) $prevEstate = Estate::orderBy('id', 'DESC')->first();

        $nextEstate = Estate::where('id', '>', $id)->first();
        if (!$nextEstate) $nextEstate = Estate::orderBy('id')->first();

        $estate->prevId = $prevEstate->id;
        $estate->nextId = $nextEstate->id;
        $estate->endSponsor = $estate->getSponsorEndDate();

        return response()->json($estate);
    }

    public function filter(Request $request)
    {
        $data = $request->all();

        if (strlen($data['place']['address']) == 0) {
            $estates = Estate::where('is_visible', true)->with('services')->with('images')->get();
            foreach ($estates as $estate) $estate->endSponsor = $estate->getSponsorEndDate();
            $estates = $estates->sortByDesc('updated_at')->values();
            $estates = $estates->sortByDesc('endSponsor')->values();
            return response()->json($estates);
        } else {
            $requiredServices = array_keys(array_filter($data['services']));
            $withinRadiusEstates = [];
            $place_lat = $data['place']['lat'];
            $place_lon = $data['place']['lon'];
            $radius = $data['radius'];

            $estates = Estate::where('is_visible', true)
                ->where('beds', '>=', $data['minBeds'])->where('rooms', '>=', $data['minRooms'])
                ->whereHas('services', function ($query) use ($requiredServices) {
                    $query->whereIn('label', $requiredServices);
                }, '=', count($requiredServices))
                ->with('services')->with('images')->get();

            // Return estates within the radius specified
            $withinRadiusEstates = $this->checkDistance($place_lat, $place_lon, $radius, $estates);

            // Add end sponsor date to each estates
            foreach ($withinRadiusEstates as $estate) $estate->endSponsor = $estate->getSponsorEndDate();

            // Sort estates by sponsor
            // If both estate in comparison has null or not null sponsor, sort them by distance
            usort($withinRadiusEstates, function ($a, $b) {
                if (!is_null($a->endSponsor) && !is_null($b->endSponsor)) {
                    return $a->distance - $b->distance;
                } elseif (!is_null($a->endSponsor)) {
                    return -1;
                } elseif (!is_null($b->endSponsor)) {
                    return 1;
                } else {
                    return $a->distance - $b->distance;
                }
            });

            return response()->json($withinRadiusEstates);
        }
    }

    public function checkDistance($place_lat, $place_lon, $r, $estates)
    {
        $withinRadiusEstates = [];

        foreach ($estates as $estate) {
            // Convert latitude and longitude from degrees to radians
            $lat1 = deg2rad($place_lat);
            $lon1 = deg2rad($place_lon);
            $lat2 = deg2rad($estate->latitude);
            $lon2 = deg2rad($estate->longitude);

            // Haversine formula to calculate the distance
            $dLat = $lat2 - $lat1;
            $dLon = $lon2 - $lon1;
            $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            // Radius of the Earth in kilometers
            $earthRadius = 6371.0;

            // Calculate the distance
            $distance = $earthRadius * $c;

            // Create an array only with estates within radius
            if ($distance <= $r) {
                $estate->distance = $distance;
                $withinRadiusEstates[] = $estate;
            }
        }

        return $withinRadiusEstates;
    }
}
