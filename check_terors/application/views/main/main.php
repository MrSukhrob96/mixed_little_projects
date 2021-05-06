<div class="container-fluid mt-5">
	    <form method="post" class="needs-validation" action="result" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-md-8 col-sm-6">
                    <input type="file" class="custom-file-input" name="excel" id="customFileLang" lang="ru">
                    <label class="custom-file-label" for="customFileLang">Выберите файл</label>
				</div>
				<div class="col-lg-1 col-md-2 col-sm-3">                                                                         
					<select class="form-control" name="percent">
					<?php
					for($i = 50; $i <= 100; $i+=5)
					{
					  echo "<option value=".$i.">".$i."%</option>";
					}
					?>
					</select>					
                </div>
				<div class="col-lg-1 col-md-2 col-sm-3">
					<button type="submit" class="btn btn-secondary" name="saveData">Импорть</button>
				</div>
            </div>
        </div>
    </form>
</div>


