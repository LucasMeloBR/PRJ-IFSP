<?php
	require("common.php");
	require("db.php");
														
														$id=$_GET["id"];
                                        				
                                                		echo '<div class="modal-header">
                                        <h5 class="modal-title" id="addModallabel">Deletar Plano de Ação</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form data-toggle="validator" action="actiondelete.php" method="post">
                                    			<input type="hidden" name="id" value="'.$id.'" id="'.$id.'" /><div class="form-row"><div class="col-md-12 mb-3">
												<div class="alert alert-danger rounded" role="alert">Deseja remover esse plano de ação ?</div></div></div>';
                                        	?>
                                            
											<div class="modal-footer justify-content-center">
                                        		<button type="button" class="btn btn-outline-primary" data-dismiss="modal">NÃO</button>
                                        		<button type="submit" id="enviar" class="btn btn-primary">SIM</button>
                                    		</div>
                                        </form>
                                    </div>
