<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"><![endif]-->
    <title>Crowbars 2017</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="favicon.png" type="image/x-icon" sizes="16x16">
    <style type="text/css">
      .form--label{ margin-top: 10px; }
      input[type=text]{ padding: 5px; }
    </style>
  </head>
  <body class="home" style="padding:20px;">
    <form id="form--signup" action="/api/submission" enctype="multipart/form-data" method="post">
      <div class="form--fields">
        <div class="form--field">
          <div class="form--label">
            <label>Title</label>
          </div>
          <div class="form--input">
            <input class="form--control" type="text" name="title" value="this is title!">
          </div>
        </div>
        <div class="form--field">
          <div class="form--label">
            <label>Alias</label>
          </div>
          <div class="form--input">
            <input class="form--control" type="text" name="alias" value="this is alias!">
          </div>
        </div>
        <div class="form--field">
          <div class="form--label">
            <label>Category *</label>
          </div>
          <div class="form--input">
            <select class="form--control" name="category_main_id" id="category_main"></select>
          </div>
        </div>
        <div class="form--field">
          <div class="form--label">
            <label>Sub Category</label>
          </div>
          <div class="form--input">
            <select class="form--control" name="category_sub_id" id="category_sub"></select>
          </div>
        </div>
        <div class="form--field">
          <div class="form--label">
            <label>Ordering</label>
          </div>
          <div class="form--input">
            <p>New items default to the last position.</p>
          </div>
        </div>
        <div class="form--field">
          <div class="form--label">
            <label>Zip *</label>
          </div>
          <div class="form--input">
            <div class="form--input--file">
              <input class="form--control" type="text" name="filename_text"><span class="_button">
                <button type="button">Select Filename</button>
                <input type="file" name="zip"></span>
            </div>
          </div>
        </div>
        <div class="form--field">
          <div class="form--label">
            <label>Version</label>
          </div>
          <div class="form--input">
            <input class="form--control" type="text" name="version" value="1.2.3">
          </div>
        </div>
      </div>
      <div class="form--submit">
        <button type="submit" style="padding: 5px 10px; margin: 10px 0;">Sign Up</button>
      </div>
    </form>    
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="/js/scripts.js"></script>
  <script type="text/javascript" src="/js/category.js"></script>
</html>