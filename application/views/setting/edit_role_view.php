<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">MENU</h4>
            </div>
            <form class ='form-horizontal' action="<?php echo base_url();?>setting/role/edit_role" method="post">
                <div class="modal-body">    
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr> 
                                <th>No</th>
                                <th>Menu</th>
                                <th>Access</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php 
							$this->session->set_userdata('no',1);
							$nm = 1;
							foreach($parent as $row){?>
                            <tr>
                                <th colspan=2 style="background:lightgray"><?php echo $row->menu;?>
								<input type="hidden" name="parmen<?php echo $nm;?>" value="<?php echo $row->id_menu;?>"></th>
                                <th style="background:lightgray">
								<?php
									$sqls = mysql_query("select count(*) as total from tbl_role_access where menu_id = '".$row->id_menu."' and lembaga_id = '".$lembaga."'");
									$gets = mysql_fetch_array($sqls);
									if($gets['total']==0){?>
								<input type="checkbox" value="1" name="parent<?php echo $nm;?>">
									<?php }else{?>
								<input type="checkbox" value="1" name="parent<?php echo $nm;?>" checked>	
									<?php } ?>
								</th>
                            </tr>
							<?php
							$no = $this->session->userdata('no');
							$det = mysql_query("select * from tbl_menu where parent_menu = '".$row->id_menu."'");
							while($rows = mysql_fetch_array($det)){?>
							<tr>
							<td><?php echo $no;?></td>
                                <td><?php echo $rows['menu'];?>
								<input type="hidden" name="kode<?php echo $no;?>" id="kode<?php echo $no;?>" value="<?php echo $rows['id_menu'];?>">
								</td>
                                <td class="td-actions">
									<?php
									$sql = mysql_query("select count(*) as total from tbl_role_access where menu_id = '".$rows['id_menu']."' and lembaga_id = '".$lembaga."'");
									$get = mysql_fetch_array($sql);
									if($get['total']==0){?>
                                    <input type="checkbox" name="menu<?php echo $no;?>" value="1" id="menu<?php echo $no;?>">
									<?php }else{ ?>
									<input type="checkbox" name="menu<?php echo $no;?>" value="1" id="menu<?php echo $no;?>" checked>
									<?php } ?>
                                </td>
							</tr>
							<?php 
							$no++; 
							$this->session->set_userdata('no',$no);
							}
							$nm++; } ?>
                        </tbody>
                    </table>
					<input type="hidden" name="trows" id="trows" value="<?php echo $no-1;?>">
					<input type="hidden" name="prows" id="prows" value="<?php echo $nm-1;?>">
					<input type="hidden" name="id_lembaga" id="id_lembaga" value="<?php echo $lembaga;?>">
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    <input type="submit" class="btn btn-primary" value="Simpan"/>
                </div>
            </form>