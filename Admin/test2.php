<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form with Summernote Editor</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Summernote CSS -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Contact Form</h2>
    <form id="contactForm">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="summernote" name="message"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb1H7y4BKE6p3AoSr0f6aeZ9onkTkxFZC7514e0pF5G1R6K4t" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYe6LYclmtdX1a81h4y5mg4I1+7wW0E4YqElj3/Jr62xUHrP6X/19BKlQKe7zZ2" crossorigin="anonymous"></script>
  <!-- Summernote JS -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#summernote').summernote({
        placeholder: 'Write your message here...',
        tabsize: 2,
        height: 200
      });

      $('#contactForm').on('submit', function(e) {
        e.preventDefault();

        // Collect form data
        var formData = $(this).serializeArray();

        // Log form data to console (for demonstration purposes)
        console.log(formData);

        // Here you can handle the form submission, e.g., send data to server
        // $.post('your-server-endpoint', formData, function(response) {
        //   // Handle server response here
        // });

        alert('Form submitted successfully!');
      });
    });
  </script>
</body>
</html>
