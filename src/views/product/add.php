<div class="row justify-content-center ">
    <div class="col-12 col-md-8 p-3 " id="">

        <form action="<?=URL?>product/add" method="POST" id="login"class=" bg-white p-3 my-auto rounded" enctype="multipart/form-data">
            
            <h2 class="text-center ">Agregar producto</h2>

            <?php 
            if(isset($this->message) && $this->message != null){ 
                if($this->message['type'] == 'success'){
                    $type_message = 'alert-success';
                }else{
                    $type_message = 'alert-danger';
                }
            ?>

                <div class="alert <?=$type_message?> d-flex align-items-center " role="alert">
                    <span class="my-auto mx-auto"> 
                        <?=$this->message['content']?>
                    </span>    
                </div>

            <?php 
            }
            ?>

            <?php 
            $title = isset($this->data)? $this->data['title'] : null;
            $description = isset($this->data)? $this->data['description'] : null;
            $amount = isset($this->data)? $this->data['amount'] : null;
            $price = isset($this->data)? $this->data['price'] : null;
            ?>

            <div class="mb-3">
                <label for="title" class="form-label ">Titulo</label>
                <div class="input-group input-group-sm">
                    <input type="text" name="title" class="form-control" id="title" value="<?=$title?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label ">Descripcion</label>
                <div class="input-group input-group-sm">
                    <textarea class="form-control" rows="5" name="description" id="description" required><?=$description?></textarea>
                </div>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label ">Cantidad</label>
                <div class="input-group input-group-sm">
                    <input type="number" id="amount" name="amount" class="form-control" value="<?=$amount?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label ">Precio</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">$</span>
                    <input type="number" id="price" name="price" class="form-control" value="<?=$price?>" >
                </div>
            </div>

            <div class="mb-3">
                <?php $categories = Utils::showCategories(); ?>
                <label for="category" class="form-label ">Categoria</label>
                <select class="form-select form-select-sm" id="category" name="category">
                    <?php foreach($categories as $category): ?>
                    <option value="<?=$category['id']?>"><?=$category['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label ">Imagen</label>
                <div class="input-group input-group-sm">
                    <input type="file" class="form-control form-sm" id="image" name="image">
                </div>
            </div>
           

            <button type="submit" name="submit" class="btn btn-danger w-100">Ingresar</button>

        </form>

    </div>
</div>
