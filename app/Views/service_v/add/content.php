<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Services </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start  -->
                    <form action="<?php echo base_url("service/save"); ?>" method="post"
                          enctype="multipart/form-data">
                        <?=csrf_field();?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"
                                       class="form-control <?=($validation->hasError('title')) ? 'is-invalid' : ''?>"
                                       id="title" name="title"
                                       placeholder="Choose Service Title" value="<?=old('title')?>">
                                <div class="invalid-feedback">
                                    <?=$validation->getError('title')?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="summernote">Content</label>
                                <textarea name="description"
                                          class="mr-auto ml-auto mt-auto <?=($validation->hasError('description')) ? 'is-invalid' : ''?>"
                                          id="summernote"><?=old('description')?></textarea>
                                <div class="invalid-feedback">
                                    <?=$validation->getError('description')?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="templateButtonsRight">Service Price</label>
                                            <input class="form-control <?=($validation->hasError('price')) ? 'is-invalid' : ''?>" type="number" name="price" data-prefix="₺"
                                                   id="templateButtonsRight"
                                                   data-decimals="2" value="0.0" step="0.1"/>
                                            <div class="invalid-feedback">
                                                <?=$validation->getError('price')?>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <img src="/assets/uploads/default.jpg" class="img-thumbnail img-preview" alt="preview">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Select Service Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                               class="custom-file-input <?=($validation->hasError('minel')) ? 'is-invalid' : ''?>"
                                                               id="minel" name="minel" onchange="previewImg()">
                                                        <div class="invalid-feedback">
                                                            <?=$validation->getError('minel')?>
                                                        </div>
                                                        <label class="custom-file-label" for="minel">Choose
                                                            file</label>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                    </form>
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
        </div>
    </div><!-- /.container-fluid -->
</section>



