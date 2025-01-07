
function previewImages(event) {
const previewContainer = document.getElementById('preview-container');
previewContainer.innerHTML = ''; // مسح المعاينات السابقة
const files = event.target.files;

Array.from(files).forEach((file, index) => {
const reader = new FileReader();
reader.onload = function (e) {
    // إنشاء عنصر الصورة
    const imageWrapper = document.createElement('div');
    imageWrapper.style.marginBottom = '10px';

    const imageElement = document.createElement('img');
    imageElement.src = e.target.result;
    imageElement.style.width = '100px';
    imageElement.style.height = '100px';
    imageElement.style.objectFit = 'cover';
    imageElement.style.marginRight = '10px';

    // إضافة حقل التعليق
    const commentInput = document.createElement('input');
    commentInput.type = 'text';
    commentInput.name = `image_comments[${index}]`;
    commentInput.placeholder = 'أضف تعليقًا على هذه الصورة';
    commentInput.style.width = '300px';

    // إضافة الصورة وحقل التعليق إلى المعاينة
    imageWrapper.appendChild(imageElement);
    imageWrapper.appendChild(commentInput);
    previewContainer.appendChild(imageWrapper);
};
reader.onerror = function () {
    console.error('Failed to read file:', file.name);
};
reader.readAsDataURL(file);
});
}


function previewDocuments(event) {
const previewContainer = document.getElementById('documents-preview-container');
previewContainer.innerHTML = ''; // مسح المعاينات السابقة
const files = event.target.files;

Array.from(files).forEach((file, index) => {
const fileName = file.name;
const documentWrapper = document.createElement('div');
documentWrapper.style.marginBottom = '10px';

if (fileName.match(/\.(jpg|jpeg|png)$/)) {
    const reader = new FileReader();
    reader.onload = function (e) {
        const imageElement = document.createElement('img');
        imageElement.src = e.target.result;
        imageElement.style.width = '100px';
        imageElement.style.height = '100px';
        imageElement.style.objectFit = 'cover';
        imageElement.style.marginRight = '10px';

        const commentInput = document.createElement('input');
        commentInput.type = 'text';
        commentInput.name = `document_comments[${index}]`;
        commentInput.placeholder = 'أضف تعليقًا على هذه الوثيقة';
        commentInput.style.width = '300px';

        documentWrapper.appendChild(imageElement);
        documentWrapper.appendChild(commentInput);
        previewContainer.appendChild(documentWrapper);
    };
    reader.onerror = function () {
        console.error('Failed to read file:', file.name);
    };
    reader.readAsDataURL(file);
} else {
    const fileNameElement = document.createElement('span');
    fileNameElement.textContent = fileName;
    fileNameElement.style.marginRight = '10px';

    const commentInput = document.createElement('input');
    commentInput.type = 'text';
    commentInput.name = `document_comments[${index}]`;
    commentInput.placeholder = 'أضف تعليقًا على هذه الوثيقة';
    commentInput.style.width = '300px';

    documentWrapper.appendChild(fileNameElement);
    documentWrapper.appendChild(commentInput);
    previewContainer.appendChild(documentWrapper);
}
});
}
