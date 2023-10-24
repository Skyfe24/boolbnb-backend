const inputFiles = document.getElementById('multiple_images');
const previewImagesField = document.getElementById('rowImages');
const previewTitle = document.getElementById('previewTitle');
const oldImagesField = document.getElementById('oldImages');


inputFiles.addEventListener('change', () => {

    if (oldImagesField) oldImagesField.classList.add('d-none');
    let imagePreviewContent = "";
    if (inputFiles.files[0]){
        previewTitle.innerText = 'Preview Immagini attualmente selezionate';
        const imgFiles = Array.from(inputFiles.files);
        imgFiles.forEach(image => {
            const blobUrl = URL.createObjectURL(image);
            imagePreviewContent += `<div class="col-12 col-md-2 p-2"><img class="previewImages" src="${blobUrl}" alt=""></div>`;
        });
    } else {
        previewTitle.innerText = 'Nessuna immagine selezionata';
        imagePreviewContent = '';
    }
    previewImagesField.innerHTML = imagePreviewContent;
});
