<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <div class="main">

    <div>


      <div class="manage">
        <div>
          <p class="heading1">Manage Posts</p>

          <div>
            <form id="form" style="margin-top:20px">
              <div class="inputDiv">
                <label for="number" class="label">Number of Posts</label><br>
                <input class="number" type="number" value="<?php echo get_option('numberOfpages') ?>" name="number">
              </div>
              <div class="inputDiv2">
                <label class="label" for="number">Select Category</label><br>
                <?php
                $terms = get_terms(
                  array(
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                  )
                );
                $option = get_option('categories');
                if (!empty($terms) && !is_wp_error($terms)) { ?>
                  <select name="category" id="" class="select-menu">
                    <option value="" disabled selected>Select an option</option>
                    <?php foreach ($terms as $term) {
                      $selects = ($option === $term->slug) ? 'selected' : ''; ?>
                      <option value="<?php echo $term->slug ?>" <?php echo $selects ?>><?php echo $term->name ?></option>
                    <?php } ?>
                  </select>
                <?php } ?>


              </div>

              <div>
              
                <div>
                  <label class="thumb" for="thumb">Thumbnail</label><br>
                  <div class="radio-thumb">
                    <div>

                      <input class="radio" name="radio" type="radio"><span class="rad">yes</span>
                    </div>
                    <div>

                      <input class="radio" name="radio" type="radio"><span class="rad">no</span>
                    </div>
                  </div>
                </div>
                <div class="thumbs">
                  <label class="thumb-sze" for="thumb">Thumbnail Size</label><br>
                  <div >
                    <div>

                      <label for="thumb-sze"></label>
                    </div>
                    <div>

                      <input class="size" name="radio" type="number">
                    </div>
                  </div>
                </div>
                <div>
                  <label class="thumb-sze" for="thumb">Alignment</label><br>
                  <div >
                    <div>

                      <label for="thumb-sze"></label>
                    </div>
                    <div class="radio-thumb">
                    <div>

                      <input class="radio" name="radio" type="radio"><span class="rad">Row</span>
                    </div>
                    <div>

                      <input class="radio" name="radio" type="radio"><span class="rad">Column</span>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="thumbs">
                  <label class="thumb-sze" for="thumb">Word Limit for Excerpt</label><br>
                  <div >
                    <div>

                      <label for="thumb-sze"></label>
                    </div>
                    <div>

                      <input class="size" name="radio" type="number">
                    </div>
                  </div>
                </div>
                <div class="thumbs">
                  <label class="thumb-sze" for="thumb">Button Text</label><br>
                  <div >
                    <div>

                      <label for="thumb-sze"></label>
                    </div>
                    <div>

                      <input class="size" name="radio" type="number">
                    </div>
                  </div>
                </div>
              </div>
              <input type="submit" class="btnPlugin" value="Save changes" style="margin-top:20px">
              <p id="loading">loading...</p>
            </form>
          </div>
        </div>



      </div>


     
    </div>
  </div>
  <script>

    (function ($) {
      $("#loading").hide()

      $('#form').submit((event) => {

        event.preventDefault()
        const ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>"
        const formdata = new FormData(document.getElementById('form'))
        $("#loading").show()
        formdata.append('action', 'form')

        $.ajax(ajax_url, {
          method: "POST",
          data: formdata,
          processData: false,
          contentType: false,
          success: function (res) {
            $("#loading").hide()
          },

          error: function (err) {
            console.log(err);
            // alert(err.response)
          }
        })


      })
    }(jQuery))


  </script>
</body>

</html>