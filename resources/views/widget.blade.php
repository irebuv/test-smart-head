<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Widget</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-transparent p-2" >
    <div class="card shadow-sm border-0 p-4" style="max-width: 500px;">
      <form id="ticket-form">
        <div>
          <label class="form-label" for="name">Your Name<span class="text-danger">*</span></label><br>
          <input class="form-control" id="name" type="text" name="name" placeholder="Write your name">
          <span class="input-error text-danger" id="error-name"></span>
        </div>
        <div class="mt-4">
          <label class="form-label" for="email">Your Email<span class="text-danger">*</span></label><br>
          <input class="form-control" id="email" type="text" name="email" placeholder="Write your email">
          <span class="input-error text-danger" id="error-email"></span>
        </div>
        <div class="mt-4">
          <label class="form-label" for="number">Your number<span class="text-danger">*</span></label><br>
          <input class="form-control" id="number" type="text" name="number" placeholder="Write your number">
          <span class="input-error text-danger" id="error-number"></span>
        </div>
        <div class="mt-4">
          <label class="form-label" for="description">Write description below (optional)</label><br>
          <textarea class="form-control" id="description" type="text" name="description" placeholder="Write your description"></textarea>
          <span class="input-error text-danger" id="error-description"></span>
        </div>
        <div class="mt-4">
          <label class="form-label" for="theme">Your Theme<span class="text-danger">*</span></label><br>
          <input class="form-control" id="theme" type="text" name="theme" placeholder="Write your theme">
          <span class="input-error text-danger" id="error-theme"></span>
        </div>
        <div class="mt-4">
            <label for="files" class="form-label">Files (optional)</label>
            <input type="file" id="files" name="files[]" class="form-control" multiple>
            <span class="text-light-emphasis"><span class="text-danger">*</span>only: png, jpeg, txt (max: 2MB)</span>
            <span class="input-error text-danger" id="error-files"></span>
        </div>

        <div id="form-message" class="small mt-3"></div>

        <button type="submit" class="btn btn-primary mt-4">Submit</button>
      </form>
    </div>
</body>

</html>
