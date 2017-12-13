<h1>Товары</h1>

<form action="<?php echo base_url(); ?>products/index" method="get">
	<div class="row">
		<h4 class="padding-left-right-5-5">ПОИСК:</h4>
		<div class="col-sm-4 padding-left-right-5-5 form-group">
		    <input type="text" name="title" placeholder="Название" value="<?php echo (!empty($filters['title'])) ? $filters['title'] : ''; ?>" class="form-control" id="title" placeholder="">
		</div>
		<div class="col-sm-4 padding-left-right-5-5 form-group">
		    <input type="text" name="vendor_code" placeholder="Артикул" value="<?php echo (!empty($filters['vendor_code'])) ? $filters['vendor_code'] : ''; ?>" class="form-control" id="vendor_code" placeholder="">
		</div>

	    <div class="col-sm-1 padding-left-right-5-5">
	      <button type="submit" class="btn btn-primary">Поиск</button>
	    </div>
	    <div class="col-sm-1 padding-left-right-5-5">
	    	<a href="<?php echo base_url(); ?>products/index">
	      		<button type="button" class="btn btn-primary">Сбросить результаты поиска</button>
	      	</a>
	    </div>
	</div>
</form>

<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Название</th>
			<th>Описание</th>
			<th>Короткое описание</th>
			<th>Категория</th>
			<th>Цена</th>
			<th>Скидка</th>
			<th>Цена по скидке</th>
			<th>Артикул</th>
			<th>Наличие</th>
			<th>Изображение</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($products as $each_product) { ?>
			<tr>
				<td><?php echo $each_product->product_id; ?></td>
				<td><?php echo $each_product->title; ?></td>
				<td><?php echo $each_product->description; ?></td>
				<td><?php echo $each_product->short_description; ?></td>
				<td>
					<ol>
						<?php foreach ($each_product->categories as $category) { ?>
							<?php echo '<li>' . $category->title . '</li>' ?>
						<?php } ?>
					</ol>	
				</td>
				<td><?php echo $each_product->price; ?></td>
				<td><?php echo $each_product->sale_percent; ?></td>
				<td><?php echo $each_product->sale_price; ?></td>
				<td><?php echo $each_product->vendor_code; ?></td>
				<td>
					<?php if($each_product->is_available) { ?>
						Да
					<?php } else { ?>
						Нет
					<?php } ?>
				</td>
				<td>
					<?php if($each_product->img_name && file_exists($this->config->item('upload_path') . $each_product->img_name)) { ?>
						<a data-lightbox="product-image-<?php echo $each_product->product_id; ?>" href="<?php echo base_url(); ?>images/<?php echo $each_product->img_name; ?>">
							<img src="<?php echo base_url(); ?>images/<?php echo $each_product->img_name; ?>" width="40">
						</a>
					<?php } else { ?>
						<img src="<?php echo base_url(); ?>images/placeholder.png" width="40">
					<?php } ?>
				</td>
				<td align="right">
					<a class="color-black" href="<?php echo base_url(); ?>products/update/<?php echo $each_product->product_id; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
					<a class="color-black" href="<?php echo base_url(); ?>products/delete/<?php echo $each_product->product_id; ?>"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<a href="<?php echo base_url(); ?>products/create" class="btn btn-primary pull-right">Добавить</a>

<div class="pagination-center">
	<ul class="pagination">
		<?php foreach ($links as $link) {
			echo $link;
		} ?>
	</ul>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
		$('.current').parent('li').attr('class','active');
    });
</script>

