<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <style>
        /* General Styles */
       /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #1c1c1c;
    color: #fff;
}

/* Header */
header {
    background-color: rgba(255, 255, 255, 0.9);
    border-bottom: 1px solid #e2e2e2;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000;
}

header h1 {
    font-size: 24px;
    color: #fff;
    margin: 0;
}

header .logo {
    font-size: 24px;
    font-weight: bold;
    color: #e60023;
    text-decoration: none;
}

/* Search Bar */
.search-barbar {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px auto;
    width: 100%;
}

.search-barbar input {
    width: 50%;
    padding: 10px 15px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 25px;
    outline: none;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.search-barbar input:focus {
    border-color: rgb(63, 154, 219);
    box-shadow: 0 0 8px rgba(96, 226, 200, 0.5);
}

.search-barbar i {
    position: absolute;
    left: calc(81% - 135px);
    color: #999;
    font-size: 20px;
    pointer-events: none;
}

@media screen and (max-width: 768px) {
    .search-barbar input {
        width: 80%;
    }
    .search-barbar i {
        left: calc(100% + 15px);
    }
}

/* Main Grid */
main.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.grid-item {
    position: relative;
    background-color: #222;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.grid-item img {
    width: 100%;
    height: auto;
    display: block;
    filter: blur(3px);
    transition: filter 0.3s ease;
}

.grid-item:hover img {
    filter: blur(0);
}

.grid-item:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal-content {
    display: flex;
    background-color: #222;
    border-radius: 10px;
    padding: 20px;
    width: 80%;
    max-width: 900px;
    max-height: 90vh;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
    overflow: hidden;
}

.modal-content img {
    width: 50%;
    height: auto;
    border-radius: 10px;
    margin-right: 20px;
    object-fit: cover;
}

.modal-details {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow-y: auto;
}

.modal-details h3 {
    font-size: 1.5rem;
    margin: 0;
}

.modal-details p {
    margin: 10px 0;
    line-height: 1.6;
}

.actions {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 20px;
}

.actions button {
    background-color: rgb(0, 0, 0);
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
}

.actions button:hover {
    background-color: rgb(53, 201, 186);
}

/* Comments Section */
.comments-section {
    margin-top: 20px;
    background: #333;
    padding: 15px;
    border-radius: 8px;
    max-height: 200px;
    overflow-y: auto;
}

.comments-section h4 {
    color: #fff;
}

.comment-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: start;
}

.comment {
    flex: 1 1 calc(100% - 10px);
    max-width: 100%;
    background: #444;
    border-radius: 6px;
    padding: 10px;
    margin: 5px 0;
    color: #fff;
}

.comment:hover {
    transform: translateY(-2px);
}

.comment strong {
    color: #fff;
}

/* Comment Form */
.comment-form {
    display: flex;
    flex-direction: column;
    margin-top: 10px;
}

.comment-form textarea {
    resize: none;
    padding: 10px;
    border-radius: 5px;
    border: none;
    margin-bottom: 10px;
}

.comment-form button {
    align-self: flex-end;
    padding: 8px 20px;
    background-color: #007bff;
    border: none;
    color: white;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
}

.comment-form button:hover {
    background-color: #0056b3;
}

/* Modal Close Button */
.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #fff;
    cursor: pointer;
}

.modal-close:hover {
    color: #e60023;
}

/* Responsive Styles */
@media (min-width: 600px) {
    .comment {
        flex: 1 1 calc(50% - 10px);
        max-width: calc(50% - 10px);
    }
}

@media (min-width: 900px) {
    .comment {
        flex: 1 1 calc(33.33% - 10px);
        max-width: calc(33.33% - 10px);
    }
}
</style>
</head>
<body>
<?php include "navbar.php"; ?>

<div class="search-barbar">
    <i class="fas fa-search"></i>
    <input type="text" id="searchInput" placeholder="Search for ideas..." onkeyup="filterPhotos()">
</div>

<main class="grid" id="photoGrid">
    <?php
    $conn = new mysqli("localhost", "root", "", "gallerydb_plusdummy");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT FotoID, JudulFoto, LokasiFoto, DeskripsiFoto, TanggalUnggah, 
    (SELECT COUNT(*) FROM likefoto WHERE likefoto.FotoID = foto.FotoID) AS Likes
        FROM foto";
    $result = $conn->query($sql);

    $photos = []; // Array untuk menyimpan data foto

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $photos[] = $row; // Simpan setiap foto ke dalam array
            echo "
            <div class='grid-item'>
                <img src='uploads/{$row['LokasiFoto']}' alt='{$row['JudulFoto']}' onclick='openModal(\"uploads/{$row['LokasiFoto']}\", \"{$row['JudulFoto']}\", \"{$row['DeskripsiFoto']}\", \"{$row['Likes']}\", \"{$row['TanggalUnggah']}\", {$row['FotoID']})'>
            </div>";
        }
    } else {
        echo "<p>No photos found!</p>";
    }

    $conn->close();
    ?>
</main>

<!-- Modal -->
<div id="photoModal" class="modal">
    <div class="modal-content">
    <span class="modal-close" onclick="closeModal()">&times;</span>
        <!-- Gambar berada di kiri -->
        <img id="modalImage" src="" alt="Photo">

        <!-- Bagian kanan untuk detail -->
        <div class="modal-details">
            <h3 id="modalTitle"></h3>
            <p id="modalDescription"></p>
            <p><strong>Likes:</strong> <span id="modalLikes"></span></p>
            <p><strong>Uploaded on:</strong> <span id="modalDate"></span></p>
            <div class="actions">
                <button onclick="likePhoto(event, currentFotoID)">❤️ Like</button>
                <button onclick="toggleCommentSection()">💬 View Comments</button>
            </div>
            <div class="comments-section" id="comments-section" style="display: none;">
                <h4>Comments:</h4>
                <div id="comments-"></div>
                <form class="comment-form" onsubmit="addComment(event, currentFotoID)">
                    <textarea rows="3" placeholder="Add a comment..." required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    let currentFotoID = '';
    const photos = <?php echo json_encode($photos); ?>;

    function openModal(image, title, description, likes, date, fotoID) {
        currentFotoID = fotoID;
        document.getElementById('photoModal').style.display = 'flex';
        document.getElementById('modalImage').src = image;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('modalLikes').innerText = likes;
        document.getElementById('modalDate').innerText = date;
        loadComments(fotoID);
    }

    function closeModal() {
        document.getElementById('photoModal').style.display = 'none';
    }

    function toggleCommentSection() {
        const commentSection = document.getElementById("comments-section");
        commentSection.style.display = (commentSection.style.display === "none" || commentSection.style.display === "") ? "block" : "none";
    }

    function likePhoto(event, fotoID) {
        event.preventDefault();

        const formData = new FormData();
        formData.append('FotoID', fotoID);

        fetch('like_foto.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likeCountElement = document.getElementById('modalLikes');
                let currentLikeCount = parseInt(likeCountElement.innerText);
                likeCountElement.innerText = currentLikeCount + 1;
            } else {
                alert('Failed to add like');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function addComment(event, fotoID) {
        event.preventDefault();

        const formData = new FormData();
        const textarea = event.target.querySelector('textarea');
        formData.append('FotoID', fotoID);
        formData.append('IsiKomentar', textarea.value);

        fetch('add_comment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const commentSection = document.getElementById('comments-');
                const newComment = document.createElement('div');
                newComment.classList.add('comment');
                newComment.innerHTML = `
                    <p><strong>You:</strong></p>
                    <p>${textarea.value}</p>
                `;
                textarea.value = '';
                commentSection.appendChild(newComment);
            } else {
                alert('Failed to add comment');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function loadComments(fotoID) {
        fetch(`get_comments.php?FotoID=${fotoID}`)
        .then(response => response.json())
        .then(data => {
            const commentSection = document.getElementById('comments-');
            commentSection.innerHTML = '';
            if (data.success) {
                if (data.comments.length > 0) {
                    data.comments.forEach(comment => {
                        const commentDiv = document.createElement('div');
                        commentDiv.classList.add('comment');
                        commentDiv.innerHTML = `
                            <p><strong>${comment.NamaLengkap}</strong> (${comment.TanggalKomentar}):</p>
                            <p>${comment.IsiKomentar}</p>
                        `;
                        commentSection.appendChild(commentDiv);
                    });
                } else {
                    commentSection.innerHTML = '<p>No comments yet.</p>';
                }
            } else {
                commentSection.innerHTML = '<p>Failed to load comments.</p>';
            }
        })
        .catch(error => {
            console.error('Error loading comments:', error);
            document.getElementById('comments-').innerHTML = '<p>Error loading comments.</p>';
        });
    }

    function filterPhotos() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const gridItems = document.querySelectorAll('.grid-item');

        gridItems.forEach(item => {
            const img = item.querySelector('img');
            const title = img.alt.toLowerCase();
            if (title.includes(input)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

<?php include "footer.php"; ?>
</body>
</html>
