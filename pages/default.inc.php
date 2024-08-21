<?php
/*
	Redaxo-Addon Backend-Tools
	Verwaltung: Hauptseite (Default)
	v1.9.1
	by Falko Müller @ 2018-2024
*/

//Variablen deklarieren
$form_error = 0;

//Formular dieser Seite verarbeiten
if ($func == "save" && isset($_POST['submit'])):
	//Konfig speichern
	$newCfg = $this->getConfig('config');												//alte Config laden
	$lastSlicetimer = @$newCfg['be_slicetimer'];										//gespeicherten Stand von be_slicetimer holen

	$newCfg = array_merge($newCfg, [													//neue Werte der Standardfelder hinzufügen
		'be_hplink'				=> rex_post('be_hplink'),
		'be_gototop'			=> rex_post('be_gototop'),
		
		'be_minnav'				=> rex_post('be_minnav'),
		'be_minsidebar'			=> rex_post('be_minsidebar'),
		'be_collapse_addons'	=> rex_post('be_collapse_addons'),
		'be_collapse_ycom'		=> rex_post('be_collapse_ycom'),
		'be_collapse_yformmanager'	=> rex_post('be_collapse_yformmanager'),
		
		'be_tree'				=> rex_post('be_tree'),
		'be_tree_menu'			=> rex_post('be_tree_menu'),
		'be_tree_shortnames'	=> rex_post('be_tree_shortnames'),
		'be_tree_showid'		=> rex_post('be_tree_showid'),
		'be_tree_onlystructure'	=> rex_post('be_tree_onlystructure'),
		'be_tree_activemode'	=> rex_post('be_tree_activemode'),
		'be_tree_persist'		=> rex_post('be_tree_persist'),
        
        'be_mediapool_usesort'  => rex_post('be_mediapool_usesort'),
        'be_mediapool_sort'     => rex_post('be_mediapool_sort'),

        'be_slicetimer'  			=> rex_post('be_slicetimer'),
        'be_slicetimer_workversion' => rex_post('be_slicetimer_workversion'),
		'be_slicetimer_infoblock' 	=> rex_post('be_slicetimer_infoblock'),
		
		'be_crop'				=> rex_post('be_crop'),
		'be_crop_pre1'			=> rex_post('be_crop_pre1'),
		'be_crop_pre2'			=> rex_post('be_crop_pre2'),
		'be_crop_pre3'			=> rex_post('be_crop_pre3'),
		'be_crop_pre4'			=> rex_post('be_crop_pre4'),
		'be_crop_pre5'			=> rex_post('be_crop_pre5'),
	]);

	$res = $this->setConfig('config', $newCfg);											//Config speichern (ersetzt komplett die alte Config)


	//Rückmeldung
	echo ($res) ? rex_view::info($this->i18n('a1510_settings_saved')) : rex_view::warning($this->i18n('a1510_error'));
	
	//reload Konfig
	$config = $this->getConfig('config');
		$config = aFM_maskArray($config);
		
	//Cache leeren, wenn slicetimer an/aus geschalten wird
	if ($res && rex_post('be_slicetimer') != $lastSlicetimer):			// && rex_post('be_slicetimer') != 'checked'
		rex_delete_cache();
		echo rex_view::info($this->i18n('a1510_cache_cleared'));
	endif;
		
endif;
?>


<script type="text/javascript">setTimeout(function() { jQuery('.alert-info').fadeOut(); }, 5000);</script>

<form action="index.php?page=<?php echo $page; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="subpage" value="<?php echo $subpage; ?>" />
<input type="hidden" name="func" value="save" />

<section class="rex-page-section">
    <div class="panel panel-edit">
    
		<header class="panel-heading"><div class="panel-title"><?php echo $this->i18n('a1510_head_basics'); ?></div></header>
        
		<div class="panel-body">
        
        	<legend><?php echo $this->i18n('a1510_subheader_bas1'); ?></legend>
            
			<dl class="rex-form-group form-group">
            	<dt><label for=""><?php echo $this->i18n('a1510_bas_hplink'); ?></label></dt>
                <dd>
                	<div class="checkbox toggle">
                    <label for="be_hplink">
                		<input name="be_hplink" type="checkbox" id="be_hplink" value="checked" <?php echo $config['be_hplink']; ?> /> <?php echo $this->i18n('a1510_bas_hplink_info'); ?>
                    </label>
                    </div>
                </dd>
			</dl>
            
            
			<dl class="rex-form-group form-group">
            	<dt><label for=""><?php echo $this->i18n('a1510_bas_gototop'); ?></label></dt>
                <dd>
                	<div class="checkbox toggle">
                    <label for="be_gototop">
                		<input name="be_gototop" type="checkbox" id="be_gototop" value="checked" <?php echo @$config['be_gototop']; ?> /> <?php echo $this->i18n('a1510_bas_gototop_info'); ?>
                    </label>
                    </div>
                </dd>
			</dl>
            
			
			<dl class="rex-form-group form-group"><dt></dt></dl>
            <dl class="rex-form-group form-group"><dt></dt></dl>

            
			<legend><?php echo $this->i18n('a1510_subheader_bas6'); ?> &nbsp; (<a href="javascript:;" onclick="jQuery('#options4').toggle();"><?php echo $this->i18n('a1510_showbox'); ?></a>)</legend>
            <div class="hiddencontent" id="options4">            
            
				<dl class="rex-form-group form-group">
					<dt><label for=""><?php echo $this->i18n('a1510_bas_minnav'); ?></label></dt>
					<dd>
						<div class="checkbox toggle">
						<label for="be_minnav">
							<input name="be_minnav" type="checkbox" id="be_minnav" value="checked" <?php echo @$config['be_minnav']; ?> /> <?php echo $this->i18n('a1510_bas_minnav_info'); ?>
						</label>
						</div>
					</dd>
				</dl>
				
				
				<dl class="rex-form-group form-group">
					<dt><label for=""><?php echo $this->i18n('a1510_bas_minsidebar'); ?></label></dt>
					<dd>
						<div class="checkbox toggle">
						<label for="be_minsidebar">
							<input name="be_minsidebar" type="checkbox" id="be_minsidebar" value="checked" <?php echo @$config['be_minsidebar']; ?> /> <?php echo $this->i18n('a1510_bas_minsidebar_info'); ?>
						</label>
						</div>
					</dd>
				</dl>
				
				
				<dl class="rex-form-group form-group"><dt></dt></dl>
				
				
				<dl class="rex-form-group form-group">
					<dt><label for=""><?php echo $this->i18n('a1510_bas_navcollapse'); ?></label></dt>
					<dd>
						<div class="checkbox toggle">
							<label for="be_collapse_addons">
								<input name="be_collapse_addons" type="checkbox" id="be_collapse_addons" value="checked" <?php echo @$config['be_collapse_addons']; ?> /> <?php echo $this->i18n('a1510_bas_navcollapse_addons'); ?>
							</label>
						</div>
						
						<div class="checkbox toggle">
							<label for="be_collapse_ycom">
								<input name="be_collapse_ycom" type="checkbox" id="be_collapse_ycom" value="checked" <?php echo @$config['be_collapse_ycom']; ?> /> <?php echo $this->i18n('a1510_bas_navcollapse_ycom'); ?>
							</label>
						</div>

						<div class="checkbox toggle">
							<label for="be_collapse_yformmanager">
								<input name="be_collapse_yformmanager" type="checkbox" id="be_collapse_yformmanager" value="checked" <?php echo @$config['be_collapse_yformmanager']; ?> /> <?php echo $this->i18n('a1510_bas_navcollapse_yformmanager'); ?>
							</label>
						</div>						
					</dd>
				</dl>				
			
            </div>



            <dl class="rex-form-group form-group"><dt></dt></dl>

            
			<legend><?php echo $this->i18n('a1510_subheader_bas4'); ?> &nbsp; (<a href="javascript:;" onclick="jQuery('#options2').toggle();"><?php echo $this->i18n('a1510_showbox'); ?></a>)</legend>
            <div class="hiddencontent" id="options2">

                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_mediapool_usesort'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_mediapool_usesort">
                            <input name="be_mediapool_usesort" type="checkbox" id="be_mediapool_usesort" value="checked" <?php echo @$config['be_mediapool_usesort']; ?> /> <?php echo $this->i18n('a1510_bas_mediapool_usesort_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>


                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_mediapool_sort'); ?></label></dt>
                    <dd>
                        <select name="be_mediapool_sort" size="1" class="form-control">
                            <?php
                            $arr = array(
                                "name|asc"			=> $this->i18n('a1510_bas_mediapool_sort_name'), 
                                "name|desc"			=> $this->i18n('a1510_bas_mediapool_sort_name_desc'),
                                "createdate|asc"	=> $this->i18n('a1510_bas_mediapool_sort_createdate'), 
                                "createdate|desc"	=> $this->i18n('a1510_bas_mediapool_sort_createdate_desc'),
                                "updatedate|asc"	=> $this->i18n('a1510_bas_mediapool_sort_updatedate'),
                                "updatedate|desc"	=> $this->i18n('a1510_bas_mediapool_sort_updatedate_desc')
                           );
                            
                            foreach ($arr as $key=>$value):
                                $sel = ($key == @$config['be_mediapool_sort']) ? 'selected="selected"' : '';
                                echo '<option value="'.$key.'" '.$sel.'>'.$value.'</option>';
                            endforeach;
                            ?>
                        </select>
                    </dd>
                </dl>

            </div>
             


            <dl class="rex-form-group form-group"><dt></dt></dl>            

            
			<legend><?php echo $this->i18n('a1510_subheader_bas5'); ?> &nbsp; (<a href="javascript:;" onclick="jQuery('#options3').toggle();"><?php echo $this->i18n('a1510_showbox'); ?></a>)</legend>
            <div class="hiddencontent" id="options3">

                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_slicetimer'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_slicetimer">
                            <input name="be_slicetimer" type="checkbox" id="be_slicetimer" value="checked" <?php echo @$config['be_slicetimer']; ?> /> <?php echo $this->i18n('a1510_bas_slicetimer_info'); ?>							
                        </label>
                        </div>
						
						<span class="infoblock"><?php echo rex_i18n::rawmsg('a1510_text1'); ?></span>
                    </dd>
                </dl>


				<dl class="rex-form-group form-group"><dt></dt></dl>
				

                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_slicetimer_workversion'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_slicetimer_workversion">
                            <input name="be_slicetimer_workversion" type="checkbox" id="be_slicetimer_workversion" value="checked" <?php echo @$config['be_slicetimer_workversion']; ?> /> <?php echo rex_i18n::rawmsg('a1510_bas_slicetimer_workversion_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>


                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_slicetimer_infoblock'); ?></label></dt>
                    <dd>
                        <select name="be_slicetimer_infoblock" size="1" class="form-control">
                            <?php
                            $arr = array(
                                "" 				=> $this->i18n('a1510_bas_slicetimer_infoblock_default'), 
                                "isnotvisible" 	=> $this->i18n('a1510_bas_slicetimer_infoblock_isnotvisible'),
                                "none" 			=> $this->i18n('a1510_bas_slicetimer_infoblock_none')
                           );
                            
                            foreach ($arr as $key=>$value):
                                $sel = ($key == @$config['be_slicetimer_infoblock']) ? 'selected="selected"' : '';
                                echo '<option value="'.$key.'" '.$sel.'>'.$value.'</option>';
                            endforeach;
                            ?>
                        </select>
                    </dd>
                </dl>

            </div>
			
            

            <dl class="rex-form-group form-group"><dt></dt></dl>            

            
			<legend><?php echo $this->i18n('a1510_subheader_bas2'); ?> &nbsp; (<a href="javascript:;" onclick="jQuery('#options1').toggle();"><?php echo $this->i18n('a1510_showbox'); ?></a>)</legend>
            <div class="hiddencontent" id="options1">

                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_tree'); ?></label></dt>
                    <dd>
                        <div class="radio toggle switch">
                        <label for="pos1">
                            <input name="be_tree" type="radio" value="none" id="pos1" <?php echo ($config['be_tree'] != "top" && $config['be_tree'] != "left") ? 'checked' : ''; ?> /> <?php echo $this->i18n('a1510_bas_tree_embed_none'); ?>
                        </label>
                        <br />
                        <label for="pos2">
                            <input name="be_tree" type="radio" value="top" id="pos2" <?php echo ($config['be_tree'] == "top") ? 'checked' : ''; ?> /> <?php echo $this->i18n('a1510_bas_tree_embed_top'); ?>
                        </label>
                        <br />
                        <label for="pos3">
                            <input name="be_tree" type="radio" value="left" id="pos3" <?php echo ($config['be_tree'] == "left") ? 'checked' : ''; ?> /> <?php echo $this->i18n('a1510_bas_tree_embed_left'); ?>
                        </label>
                        <br />
                        <label for="pos4">
                            <input name="be_tree" type="radio" value="right" id="pos4" <?php echo ($config['be_tree'] == "right") ? 'checked' : ''; ?> /> <?php echo $this->i18n('a1510_bas_tree_embed_right'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>


	            <dl class="rex-form-group form-group"><dt></dt></dl>
               
 
                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_tree_onlystructure'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_tree_onlystructure">
                            <input name="be_tree_onlystructure" type="checkbox" id="be_tree_onlystructure" value="checked" <?php echo $config['be_tree_onlystructure']; ?> /> <?php echo $this->i18n('a1510_bas_tree_onlystructure_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>
                
 
                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_tree_activemode'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_tree_activemode">
                            <input name="be_tree_activemode" type="checkbox" id="be_tree_activemode" value="checked" <?php echo $config['be_tree_activemode']; ?> /> <?php echo $this->i18n('a1510_bas_tree_activemode_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>
                

                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_tree_persist'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_tree_persist">
                            <input name="be_tree_persist" type="checkbox" id="be_tree_persist" value="checked" <?php echo $config['be_tree_persist']; ?> /> <?php echo $this->i18n('a1510_bas_tree_persist_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>
                
                
<!--
                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_tree_menu'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_tree_menu">
                            <input name="be_tree_menu" type="checkbox" id="be_tree_menu" value="checked" <?php echo $config['be_tree_menu']; ?> /> <?php echo $this->i18n('a1510_yes').', '.$this->i18n('a1510_bas_tree_menu_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>
-->


                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_tree_shortnames'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_tree_shortnames">
                            <input name="be_tree_shortnames" type="checkbox" id="be_tree_shortnames" value="checked" <?php echo $config['be_tree_shortnames']; ?> /> <?php echo $this->i18n('a1510_bas_tree_shortnames_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>
                
                 
                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_tree_showid'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_tree_showid">
                            <input name="be_tree_showid" type="checkbox" id="be_tree_showid" value="checked" <?php echo $config['be_tree_showid']; ?> /> <?php echo $this->i18n('a1510_bas_tree_showid_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>

			</div>

            
<!--
            <dl class="rex-form-group form-group"><dt></dt></dl>


			<legend><?php echo $this->i18n('a1510_subheader_bas3'); ?> &nbsp; (<a href="javascript:;" onclick="jQuery('#options2').toggle();"><?php echo $this->i18n('a1510_showbox'); ?></a>)</legend>
 			<div class="hiddencontent" id="options2">
                 
                <dl class="rex-form-group form-group">
                    <dt><label for=""><?php echo $this->i18n('a1510_bas_crop'); ?></label></dt>
                    <dd>
                        <div class="checkbox toggle">
                        <label for="be_crop">
                            <input name="be_crop" type="checkbox" id="be_crop" value="checked" <?php echo $config['be_crop']; ?> /> <?php echo $this->i18n('a1510_yes').', '.$this->i18n('a1510_bas_crop_info'); ?>
                        </label>
                        </div>
                    </dd>
                </dl>
                
                
                <dl class="rex-form-group form-group"><dt></dt></dl>
                
            
                <dl class="rex-form-group form-group">
                    <dt><label for="be_crop_pre1"><?php echo $this->i18n('a1510_bas_crop_pre1'); ?></label></dt>
                    <dd>
                    	<input type="text" size="25" name="be_crop_pre1" id="be_crop_pre1" value="<?php echo $config['be_crop_pre1']; ?>" maxlength="9" class="form-control" />
                        <span class="infoblock"><?php echo $this->i18n('a1510_bas_crop_presetformat'); ?></span>
                    </dd>
                </dl>
                
            
                <dl class="rex-form-group form-group">
                    <dt><label for="be_crop_pre2"><?php echo $this->i18n('a1510_bas_crop_pre2'); ?></label></dt>
                    <dd>
                    	<input type="text" size="25" name="be_crop_pre2" id="be_crop_pre2" value="<?php echo $config['be_crop_pre2']; ?>" maxlength="9" class="form-control" />
                        <span class="infoblock"><?php echo $this->i18n('a1510_bas_crop_presetformat'); ?></span>
                    </dd>
                </dl>
                
            
                <dl class="rex-form-group form-group">
                    <dt><label for="be_crop_pre3"><?php echo $this->i18n('a1510_bas_crop_pre3'); ?></label></dt>
                    <dd>
                    	<input type="text" size="25" name="be_crop_pre3" id="be_crop_pre3" value="<?php echo $config['be_crop_pre3']; ?>" maxlength="9" class="form-control" />
                        <span class="infoblock"><?php echo $this->i18n('a1510_bas_crop_presetformat'); ?></span>
                    </dd>
                </dl>
                
            
                <dl class="rex-form-group form-group">
                    <dt><label for="be_crop_pre4"><?php echo $this->i18n('a1510_bas_crop_pre4'); ?></label></dt>
                    <dd>
                    	<input type="text" size="25" name="be_crop_pre4" id="be_crop_pre4" value="<?php echo $config['be_crop_pre4']; ?>" maxlength="9" class="form-control" />
                        <span class="infoblock"><?php echo $this->i18n('a1510_bas_crop_presetformat'); ?></span>
                    </dd>
                </dl>
                
            
                <dl class="rex-form-group form-group">
                    <dt><label for="be_crop_pre5"><?php echo $this->i18n('a1510_bas_crop_pre5'); ?></label></dt>
                    <dd>
                    	<input type="text" size="25" name="be_crop_pre5" id="be_crop_pre5" value="<?php echo $config['be_crop_pre5']; ?>" maxlength="9" class="form-control" />
                        <span class="infoblock"><?php echo $this->i18n('a1510_bas_crop_presetformat'); ?></span>
                    </dd>
                </dl>

			</div>
-->           
             

            <script type="text/javascript">jQuery('.hiddencontent').hide();</script>
                    
            
        </div>
        
        <footer class="panel-footer">
        	<div class="rex-form-panel-footer">
            	<div class="btn-toolbar">
                	<input class="btn btn-save rex-form-aligned" type="submit" name="submit" title="<?php echo $this->i18n('a1510_save'); ?>" value="<?php echo $this->i18n('a1510_save'); ?>" />
                </div>
			</div>
		</footer>
        
	</div>
</section>

</form>