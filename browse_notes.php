<?php
include 'auth.php';
protectPage(['student', 'teacher', 'admin']);

$conn = mysqli_connect("localhost", "root", "", "collegenotes");
$subjects = mysqli_query($conn, "SELECT * FROM subjects");
?>

<?php include 'header.php'; ?>

<link rel="stylesheet" href="css/browse_notes.css">

<div class="container py-5">
    <h3 class="mb-4">Browse Notes</h3>

    <div class="row mb-4">
        <div class="col-md-5">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by title or description">
        </div>
        <div class="col-md-4">
            <select id="subjectFilter" class="form-control">
                <option value="0">All branches</option>
                <?php while ($row = mysqli_fetch_assoc($subjects)): ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-3">
            <button id="searchBtn" class="btn btn-primary w-100">Search</button>
        </div>
    </div>

    <div class="row" id="notesContainer"></div>
</div>

<script>
    const notesContainer = document.getElementById('notesContainer');

    function fetchNotes() {
        const search = document.getElementById('searchInput').value;
        const subject = document.getElementById('subjectFilter').value;

        fetch(`browse_notes_process.php?search=${encodeURIComponent(search)}&subject_id=${subject}`)
            .then(res => res.json())
            .then(notes => {
                notesContainer.innerHTML = '';
                if (notes.length === 0) {
                    notesContainer.innerHTML = '<div class="col-12 text-center"><p class="text-muted">No notes found.</p></div>';
                    return;
                }

                notes.forEach(note => {
                    const card = document.createElement('div');
                  /*  card.className = 'col-md-3 mb-4'; */   card.className = 'col-6 col-md-4 col-lg-3 mb-4';

                    card.innerHTML = `
                    <div class="card h-100 shadow-lg border-0 note-card">
                        <!-- Card Image -->
                        <img src="${note.image ? note.image : 'css/images/notes1.png'}" 
                             class="card-img-top" 
                             alt="Note Image">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">${note.title}</h5>
                            <p class="card-text text-muted">
                                ${note.description.length > 100 ? note.description.substring(0,100) + '...' : note.description}
                            </p>
                            
                            <p class="text-muted mb-1"><i class="bi bi-book"></i> <strong>Branch:</strong> ${note.subject}</p>
                            <p class="text-muted mb-1"><i class="bi bi-person"></i> <strong>By:</strong> ${note.fullname}</p>
                            <p class="text-muted mb-3"><i class="bi bi-download"></i> <strong>Downloads:</strong> ${note.download_count}</p>

                            <a href="download_note.php?id=${note.note_id}" class="btn btn-download mt-auto text-white">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    </div>
                `;
                    notesContainer.appendChild(card);
                });
            });
    }

    fetchNotes();
    document.getElementById('searchBtn').addEventListener('click', fetchNotes);
    document.getElementById('searchInput').addEventListener('keyup', e => {
        if (e.key === 'Enter') fetchNotes();
    });

    setInterval(fetchNotes, 10000);
</script>

<?php
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        $url = 'admin_dash.php';
    } elseif ($_SESSION['role'] === 'teacher') {
        $url = 'teacher_dash.php';
    } elseif ($_SESSION['role'] === 'student') {
        $url = null;
    } else {
        $url = 'homepage.php'; 
    }

    if ($url): ?>
        <a href="<?php echo $url; ?>" class="btn btn-dark bi bi-box-arrow-right" style="margin-left: 40px;">
            Back to Dashboard
        </a>
    <?php endif; 
}
?>


<?php include 'footer.php'; ?>