<?php
	require("common.php");
	require("db.php");
														
														$id=$_GET["id"];
                                        				$query = "SELECT * FROM action_plan ap
														INNER JOIN tipo_kpi tk on ap.fk_id_indicador = tk.id_tipo_kpi
														INNER JOIN kpi k on tk.fk_tipo_kpi = k.id_kpi WHERE ap.id_ac = $id";
                                        				$result = mysqli_query($connection, $query);
                                        				if (mysqli_num_rows($result) > 0) {
                                            			while ($editresult = mysqli_fetch_assoc($result)) {
                                                		echo '<div class="modal-header">
                                        <h5 class="modal-title" id="addModallabel">Editar Plano</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form data-toggle="validator" action="editaactionplan.php" method="post"> <div class="form-row">
                                    			<div class="col-md-6 mb-3">
                                        			<label for="inputCkpi2">Categoria do KPI</label>
                                        			<select id="inputCkpi2" name="inputCkpi2" class="form-control">
														<option value="'.$editresult['id_kpi'].'">' . $editresult['nome_kpi'] . '</option>
                                        			</select>
                                    			</div>
                                    			<div class="col-md-6 mb-3">
                                        			<label for="indicador2">Indicador</label>
                                        			<select id="indicador2" name="indicador2" class="form-control">
                                            			<option value="'.$editresult['id_tipo_kpi'].'">' . $editresult['nome_tipo_kpi'] . '</option>
                                        			</select>
                                    			</div>
                                			</div>
                                			<div class="form-row">
                                    			<div class="col-md-9 mb-3">
                                        			<label for="description">Descrição</label>
													<input type="text" class="form-control" id="description" name="description" placeholder="Descrição" value = "' . $editresult['nome_ac'] . '" required>
                                        			<div class="invalid-feedback">Por favor, informe uma descrição.</div>
                                    			</div>
                                    			<div class="col-md-3 mb-3">
                                        			<label for="inputstatus">Status</label>
                                        			<select id="inputstatus" name="inputstatus" class="form-control">
                                            			<option selected readyonly="true">' . $editresult['status'] . '</option>
														<option>EM ABERTO</option>
														<option>EM ANDAMENTO</option>
														<option>CONCLUÍDO</option>
                                        			</select>
                                    			</div>
                                			</div>
											<div class="form-row">
                                    			<div class="col-md-6 mb-3">
                                        			<label for="whattext">WHAT</label>
													<input type="text" class="form-control" id="whattext" name="whattext" placeholder="Por favor, informe o que ocorreu."required value = "' . $editresult['what'] . '">
                                    			</div>
                                    			<div class="col-md-6 mb-3">
                                        			<label for="whotext">WHO</label>
													<input type="text" class="form-control" id="whotext" name="whotext" placeholder="Por favor, informe quem irá atuar."required value = "' . $editresult['who'] . '">
                                    			</div>
                                			</div>
											<div class="form-row">
                                    			<div class="col-md-6 mb-3">
                                        			<label for="whytext">WHY</label>
													<input type="text" class="form-control" id="whytext" name="whytext" placeholder="Por favor, informe por quê ocorreu."required value = "' . $editresult['why'] . '">
                                    			</div>
                                    			<div class="col-md-6 mb-3">
                                        			<label for="howtext">HOW</label>
													<input type="text" class="form-control" id="howtext" name="howtext" placeholder="Por favor, informe como será resolvido."required value = "' . $editresult['how'] . '">
                                    			</div>
                                			</div>
											<div class="form-row">
                                    			<div class="col-md-4 mb-3">
                                        			<label for="wheretext">WHERE</label>
													<input type="text" class="form-control" id="wheretext" name="wheretext" placeholder="Por favor, informe onde será feita a correção."required value = "' . $editresult['where_ac'] . '">
                                    			</div>
                                    			<div class="col-md-4 mb-3">
													<label for="howmuch">HOW MUCH</label>
                                					<div class="input-group-prepend">
                                    					<span class="input-group-text">R$</span>
														<input type="text" id="howmuch" name="howmuch" class="form-control" aria-label="Amount (to the nearest real)" value = "' . $editresult['how_much'] . '">
                                					<div class="input-group-append">
                                    					<span class="input-group-text">,00</span>
                                					</div>
                                					</div>
                            					</div>
												<div class="col-md-4 mb-3">
                                        			<label for="benefitstext">BENEFÍCIOS</label>
													<input type="text" class="form-control" id="benefitstext" name="benefitstext" placeholder="Por favor, informe os benefícios."required value = "' . $editresult['benefits'] . '">
                                    			</div>
                                			</div>
											<div class="col-md12 mb-3">
                                    			<div class="form-group mb-3">
                                        			<label>DATAS</label>
                                        			<div class="input-daterange input-group" id="datepicker">
                                            			<input type="text" class="input-sm form-control" id="dataini" name="dataini" placeholder="DATA INÍCIO" / value = "' . $editresult['start_up'] . '">
                                            			<span class="input-group-addon"></span>
                                            			<input type="text" class="input-sm form-control" id="datafim" name="datafim" placeholder="DATA FINAL" / value = "' . $editresult['final_date']. '">
                                        			</div>
                                    			</div>
                        					</div>
											<div class="form-row">
                                    			<div class="col-md-4 mb-3">
                                        			<label for="focaltext">FOCAL POINT</label>
													<input type="text" class="form-control" id="focaltext" name="focaltext" placeholder="Por favor, informe o ponto focal."required value = "' . $editresult['focal_point'] . '">
                                    			</div>
                                    			<div class="col-md-4 mb-3">
                                        			<label for="ownertext">OWNER</label>
													<input type="text" class="form-control" id="ownertext" name="ownertext" placeholder="Por favor, informe o owner."required value = "' . $editresult['owner'] . '">
                                    			</div>
												<div class="col-md-4 mb-3">
                                        			<label for="managertext">MANAGER</label>
													<input type="text" class="form-control" id="managertext" name="managertext" placeholder="Por favor, informe o gerente."required value = "' . $editresult['manager'] . '">
                                    			</div>
                                			</div>
											<input type="hidden" name="id" value="'.$id.'" id="'.$id.'" />';
                                            					}
                                        				}
                                        	?>
                                            
											<div class="modal-footer justify-content-center">
                                        		<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        		<button type="submit" id="enviar" class="btn btn-primary">Salvar</button>
                                    		</div>
                                        </form>
                                    </div>