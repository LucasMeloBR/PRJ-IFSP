<?php
	require("db.php");
?>
<div class="container-fluid library-app">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <h1>Biblioteca de Processos</h1>
                    </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-4 drop-area-container">
                    <div class="card drop-area">
                        <div class="card-body">
                            <form action="/file-upload">
                                <div class="dropzone ">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8 list disable-text-selection" data-check-all="checkAll">
                    <div class="row">
						
                        <div class="col-xxl-4 col-xl-6 col-12">
                            <div class="card d-flex flex-row mb-4 media-thumb-container">
                                <a class="d-flex align-self-center" href="ViewProcess.php">
                                    <img src="img/parkin-thumb.jpg" alt="uploaded image" class="list-media-thumbnail responsive border-0" />
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
                                        <a href="ViewProcess.php" class="w-100">
                                            <p class="list-item-heading mb-1 truncate">parkin-thumb.jpg</p>
                                        </a>
                                        <p class="mb-1 text-muted text-small w-100 truncate">16.09.2018 14:39</p>
                                    </div>

                                    <div class="custom-control custom-checkbox pl-1 align-self-center">
                                        <label class="custom-control custom-checkbox mb-0">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
<script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/vendor/perfect-scrollbar.min.js"></script>
    <script src="js/vendor/dropzone.min.js"></script>
    <script src="js/vendor/mousetrap.min.js"></script>
    <script src="js/vendor/jquery.contextMenu.min.js"></script>
    <script src="js/dore.script.js"></script>
    <script src="js/scripts.js"></script>