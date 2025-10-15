<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VIDYA Notebook Feedback</title>
<style>
:root {
  --page-bg: #fff9f0;
  --note-shadow: rgba(0,0,0,0.15);
  --accent: #ff6864;
  --spiral-color: #555;
}

/* Body */
body {
  background: #f2f2f2;
  font-family: 'Poppins', sans-serif;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  margin: 0;
}

/* Header */
h2 {
  color: #333;
  margin-bottom: 8px;
  font-size: 1.5rem;
}
p {
  color: #555;
  margin-bottom: 20px;
  text-align: center;
  font-size: 0.95rem;
}

/* Wrapper block */
.wrapper {
  display: flex;
  height: 450px;
  width: 100%;
  max-width: 900px;
  gap: 50px;
  align-items: center; /* vertical centering */
  justify-content: center;
}

/* Notebook container */
.notebook {
  display: flex;
  gap: 10px;
  flex-shrink: 0;
}

/* Pages */
.page {
  width: 280px;
  height: 320px;
  background: var(--page-bg);
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  border-radius: 6px;
  position: relative;
  padding: 15px;
  /* Ruled lines */
  background-image: repeating-linear-gradient(
    to bottom,
    transparent,
    transparent 20px,
    #d0d0d0 21px
  );
}

/* Spirals */
/* Left page: right edge spirals */
.page.left::after {
  content: '';
  position: absolute;
  top: 10px;
  right: -12px;
  width: 8px;
  height: calc(100% - 20px);
  background: repeating-linear-gradient(
    to bottom,
    var(--spiral-color),
    var(--spiral-color) 4px,
    transparent 4px,
    transparent 12px
  );
  border-radius: 50%;
}

/* Right page: left edge spirals */
.page.right::after {
  content: '';
  position: absolute;
  top: 10px;
  left: -12px;
  width: 8px;
  height: calc(100% - 20px);
  background: repeating-linear-gradient(
    to bottom,
    var(--spiral-color),
    var(--spiral-color) 4px,
    transparent 4px,
    transparent 12px
  );
  border-radius: 50%;
}

/* Sticky notes */
.note {
  position: absolute;
  width: 90px;
  min-height: 70px;
  background: #fff59d;
  box-shadow: 0 4px 8px var(--note-shadow);
  border-radius: 6px;
  padding: 8px;
  font-size: 12px;
  color: #333;
  cursor: grab;
  transition: transform 0.3s, box-shadow 0.3s;
}
.note:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0,0,0,0.3);
}

/* Example sticky note positions */
.note1 { top: 20px; left: 25px; transform: rotate(-5deg); background:#fff59d;}
.note2 { top: 120px; left: 60px; transform: rotate(3deg); background:#ffd180;}
.note3 { top: 60px; left: 160px; transform: rotate(-3deg); background:#ffccbc;}
.note4 { top: 180px; left: 30px; transform: rotate(4deg); background:#c5e1a5;}

/* Feedback form */
.feedback-form {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  width: 250px;
  text-align: center;
  flex-shrink: 0;
}

.feedback-form textarea {
  width: 100%;
  padding: 6px;
  border-radius: 6px;
  border: 1px solid #ccc;
  resize: none;
  font-size: 0.9rem;
}

.feedback-form button {
  background: var(--accent);
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 8px;
  transition: 0.3s;
  font-size: 0.9rem;
}
.feedback-form button:hover {
  background: #ff4c4c;
}

/* Responsive */
@media(max-width: 650px) {
  .wrapper {
    flex-direction: column;
    height: auto;
  }
  .notebook {
    flex-direction: row;
    justify-content: center;
  }
}
</style>
</head>
<body>

<h2>📓 VIDYA Feedback Notebook</h2>
<p>Pin your feedback on the ruled notebook pages!</p>

<div class="wrapper">
  <!-- Notebook -->
  <div class="notebook">
    <div class="page left">
      <div class="note note1">Love the upload system!</div>
      <div class="note note2">Notes gallery is helpful!</div>
    </div>
    <div class="page right">
      <div class="note note3">Teacher-wise sorting please!</div>
      <div class="note note4">Clean & smooth experience!</div>
    </div>
  </div>

  <!-- Feedback form -->
  <div class="feedback-form">
    <h3>✏️ Add Your Feedback</h3>
    <form method="post" action="add_feedback.php">
      <textarea name="message" placeholder="Write your feedback..." rows="3" required></textarea><br>
      <button type="submit">Add Note</button>
    </form>
  </div>
</div>

</body>
</html>
