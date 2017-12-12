<h1>Категории</h1>

<?php echo $html; ?>

<button type="button" class="add-btn btn btn-primary">Добавить категорию</button>
  
<form action="<?php echo base_url(); ?>categories/update" method="post">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Редактирование категории</h4>
          </div>
          <div class="modal-body">
            <input type="text" name="category_id" hidden value="" id="category_id">
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" name="title" class="form-control" value="" id="title">
            </div>
                <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" name="description" class="form-control" value="" id="description">
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
                <button type="submit" class="btn btn-primary">Сохранить</button>
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
                $('#category-select').val(response.category.id).attr('value', response.category.id);
                $('#category_id').attr('value', id);
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
        $('#title, #description, #category-select').attr('value', '');
        $("#myModal").modal('show');
        $("#myModalLabel").text('Добавить новую категорию');
        $('form').attr('action', '<?php echo base_url(); ?>categories/create');
      });
    });
</script>



        

