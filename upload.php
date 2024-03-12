<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Upload Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        form {
            max-width: 400px;
            width: 100%;
        }
        .file-list {
            margin-top: 10px;
        }
        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="margin-top: 40px;">Upload a PDF to UNZAPDF</h1>
        <form class="mt-5" id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="pdfTitle" class="form-label">PDF Title or NAME</label>
                <input type="text" class="form-control" name="pdfTitle" id="pdfTitle" required>
            </div>

            <div class="mb-3">
                <label for="uploaderName" class="form-label">Uploader Name</label>
                <input type="text" class="form-control" name="uploaderName" id="uploaderName" required>
            </div>

            <div class="mb-3">
                <label for="fileInput" class="form-label">Select PDF files to upload</label>
                <input type="file" class="form-control" name="files" id="fileInput" accept=".pdf" required>
            </div>

            <button type="button" class="btn btn-success" onclick="addFile()">Add File</button>

            <div class="file-list" id="fileList"></div>

            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let fileCount = 1;

        function addFile() {
            if (fileCount <= 4) {
                const fileInput = document.getElementById('fileInput');
                const fileList = document.getElementById('fileList');

                // Create a new file input
                const newFileInput = fileInput.cloneNode(true);
                newFileInput.value = ''; // Clear the value

                // Create a new list item to display the selected file
                const listItem = document.createElement('div');
                listItem.classList.add('file-item');
                listItem.innerHTML = `
                    <span>File ${fileCount + 1}:</span>
                    <span>${fileInput.files[0].name}</span>
                `;

                // Append the new file input and list item
                fileList.appendChild(listItem);
                fileList.appendChild(newFileInput);

                fileCount++;
            } else {
                alert('You can only add up to 5 files at a time.');
            }
        }
    </script>
</body>
</html>
