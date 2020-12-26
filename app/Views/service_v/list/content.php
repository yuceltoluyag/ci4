<section class="content">
    <div class="container-fluid">
        <!-- /.Search -->
        <div class="row">
            <div class="col-6">
                <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Search services or keywords">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Services List</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <a href="<?php echo base_url('service/new_form'); ?>"
                                   class="btn btn-outline btn-primary btn-sm pull-right">
                                    <i class="fa fa-plus"></i> Add New Service</a>
                            </div>
                        </div>
                    </div>
                    <?php if (empty($items)) { ?>
                        <div class=" alert alert-info text-center ml-auto mr-auto">
                            <p>There is no data here. To add, please <a
                                        href="<?php echo base_url('service/new_form'); ?>">click</a></p>
                        </div>
                    <?php } else { ?>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap  table-bordered table-striped content-container">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-bars"></i></th>
                                    <th class="w10">#id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Transaction</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($items as $item) { ?>
                                    <tr id="ord-<?php echo $item->id; ?>">
                                        <td class="order"><i class="fas fa-bars"></i></td>
                                        <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                        <td><?php echo $item->title; ?></td>
                                        <td><?php echo character_limiter(strip_tags($item->description), 25); ?></td>

                                        <td class="w50">
                                            <div class="toggle lg">
                                                <label>
                                                    <input
                                                            data-url="<?php echo base_url("service/isActiveSetter/$item->id"); ?>"
                                                            class="isActive switchery"
                                                            type="checkbox"
                                                            data-switchery
                                                            data-color="#10c469"
                                                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                                                    /><span class="button-indecator"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center w-25">
                                            <button
                                                    data-id="<?php echo $item->id ?>"
                                                    data-url="<?php echo base_url("service/delete/$item->id"); ?>"
                                                    class="btn btn-sm btn-danger btn-outline  demoSwal">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                            <a href="<?php echo base_url("service/update_form/$item->id"); ?>"
                                               class="btn btn-sm btn-info  btn-outline"><i class="fas fa-pen"></i> Edit</a>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <!-- /.card-body -->
                </div>
                <?= $pager->links('service', 'service_pagination'); ?>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


</section>
