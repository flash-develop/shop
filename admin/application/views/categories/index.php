<h1 class="text-center-margin-bottom">Категории</h1>

<div class="row margin-bottom">
    <div class="col-md-4 col-md-offset-4">
        <div class="text-center-margin-bottom margin-10">
            <button type="button" class="add-btn btn btn-primary">Добавить категорию</button>
        </div>
        <?php echo $html; ?>
    </div>
</div>


<form method="post">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Редактирование категории</h4>
          </div>
          <div class="modal-body">
            <input type="text" name="category_id" hidden value="" id="category_id">
            <div class="form-group form-group-title">
                <label for="title">Название</label>
                <input type="text" name="title" class="form-control" value="" id="title">
                <div class="has-error">
                    <span class="help-block"><strong class="error-title"></strong></span>
                </div>
            </div>
                <div class="form-group form-group-description">
                <label for="description">Описание</label>
                <input type="text" name="description" class="form-control" value="" id="description">
                <div class="has-error">
                    <span class="help-block"><strong class="error-description"></strong></span>
                </div>
            </div>
            <div class="form-group">
                <label for="category-select">Родительская категория</label>
                <select class="form-control" name="parent_id" id="category-select">
                    <option value="0">&nbsp&nbsp&nbspНет</option>
                    <?php echo $htmlSelect; ?>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            <a class='delete_image' href="#">
                <button type="submit" class="btn btn-primary submit-btn">Сохранить</button>
            </a>
          </div>
        </div>
      </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){

      $(".edit-category").click(function() {
        
        $('.preloader').show();
        var id = $(this).attr('cat_id');

        var data = {
            "id": id
        }

        $.ajax({
            type: 'POST',
            url: base_url+'categories/ajaxRequestGetCategories',
            data: data,
            dataType: 'json',
            success: function(response){
                $('#title').attr('value', response.category.title);
                $('#description').attr('value', response.category.description);
                if (!response.category.parent_id) {
                    $('#category-select [value=0]').attr('selected', 'selected');
                } else {
                    $('#category-select [value='+response.category.parent_id+']').attr('selected', 'selected');
                }
                $('#category_id').attr('value', id);
                $('form').attr('action', base_url + 'categories/update');
                $('.preloader').hide();
                $("#myModal").modal('show');
            },
            error: function(response){
                //$('#e-mail').next('.test-error').html('Сервер не доступен.');
            }
        });
      });

        $(".delete-category").click(function() {
        $('.preloader').show();
        var id = $(this).attr('cat_id');

        var data = {
            "id": id
        }

        $.ajax({
            type: 'POST',
            url: base_url+'categories/ajaxRequestDeleteCategory',
            data: data,
            dataType: 'json',
            success: function(response){
                $('.preloader').hide();
                window.location.replace(base_url+'categories/index');
            },
            error: function(response){
                //$('#e-mail').next('.test-error').html('Сервер не доступен.');
            }
        });
      });

       $(".add-btn").click(function() {
        $('#category-select [value=0]').attr('selected', 'selected');
        $('#title, #description').attr('value', '');
        $('form').attr('action', base_url + 'categories/create');
        $("#myModal").modal('show');
        $("#myModalLabel").text('Добавить новую категорию');
      });

       $(".submit-btn").click(function() {
            $('.form-group-description').removeClass('has-error');
            $('.form-group-title').removeClass('has-error');

            $('.error-description').text('');
            $('.error-title').text('');

            var is_error = '0';

            if ($('#title').val() == '') {
                $('.form-group-title').addClass('has-error');
                $('.error-title').text('Введите название категории');
                is_error = '1';
            }
            if ($('#description').val() == '') {  
                $('.form-group-description').addClass('has-error');
                $('.error-description').text('Введите описание категории');
                is_error = '1';
            }

            if(is_error == '1') {
                return false;
            }
            
        });
    });
</script>



        

