<section class="dip-dash-sec">
          <h3><?php echo $page['desc']; ?></h3>
    <div class="row dip-form-body">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-7">
            <!-- <button type="button" class="btn btn-success" onclick="open_parent_modal(0)"><?php echo $this->lang->line('AddNewSection'); ?></button>
            <button type="button" class="btn btn-success" onclick="edit_child_item(0)"><?php echo $this->lang->line('AddNewRate'); ?></button>  -->
          </div>
          <div class="col-sm-5 form-inline text-right">
            <input  class="form-control" type="text" id="muSearch" onkeydown="doSearch(arguments[0]||event)" placeholder="<?php echo $this->lang->line('Search'); ?>"/>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <br/>
        <table id="dipgrid"></table>
        <div id="pager"></div>
        <br/>
        <br/>
      </div>
    </div>
</section>



<!-- hidden form model -->
<!-- first modal -->
<div class="modal" id="first_model" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="first_modelLabel"><?php echo $this->lang->line('RateSectionDetails'); ?></h4>
      </div>
      <form method="post" action="#" name='basicForm' id='basicForm'>
      <div class="modal-body">
        <!-- Item Edit Form -->
            <fieldset>
            <legend><?php echo $this->lang->line('LanguageSpecificDetails'); ?></legend>
              <table class="dip-lang-table table table-striped"><tbody>
                <tr>
                  <th></th>
                  <th><?php echo $this->lang->line('Name'); ?></th>
                </tr>
                <?php foreach ($client->languages as $key => $value):?>
                  <?php
                    $default = '';
                    $required = '';
                    if($value==$client->default_language){
                      $default = 'default';
                      $required = 'required';
                    }?>
                  <tr class="<?=$default;?>">
                    <td><i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></td>
                    <td><?php echo form_input('name['.$value.']','', 'class="form-control" id="dipName'.$value.'" placeholder="'.$this->lang->line('Name').' ('.$langs[$value].')" '.$required);?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody></table>
            </fieldset>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="submit" class="btn btn-success"><?php echo $this->lang->line('save'); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Cancel'); ?></button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal" id="child_model" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="first_modelLabel"><?php echo $this->lang->line('RateDetails'); ?>  </h4>
      </div>
      <form method="post" action="#" name='childForm' id='childForm'>
      <div class="modal-body">
        <!-- Item Edit Form -->
            <fieldset>
            <legend><?php echo $this->lang->line('LanguageSpecificDetails'); ?> </legend>
              <table class="dip-lang-table table table-striped"><tbody>
                <tr>
                  <th></th>
                  <th><?php echo $this->lang->line('Name'); ?> </th>
                </tr>
                <?php foreach ($client->languages as $key => $value):?>
                  <?php
                    $default = '';
                    $required = '';
                    if($value==$client->default_language){
                      $default = 'default';
                      $required = 'required';
                    }?>
                  <tr class="<?=$default;?>">
                    <td><i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></td>
                    <td><?php echo form_input('descr['.$value.']','', 'class="form-control" id="dipDescr'.$value.'" placeholder="'.$this->lang->line('Details').'  ('.$langs[$value].')" '.$required);?></td>
                    <td width="20%"><?php echo form_input('price['.$value.']','', 'class="form-control" id="dipPrice'.$value.'" placeholder="'.$this->lang->line('Price').' " '.$required);?></td>
                    <td width="100"><?php echo form_dropdown('currency['.$value.']',$currencies,$client->currency, 'class="form-control" id="dipCurrency'.$value.'" '.$required);?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody></table>
            </fieldset>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="submit" class="btn btn-success"><?php echo $this->lang->line('save'); ?> </button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Cancel'); ?> </button>
      </div>
      </form>
    </div>
  </div>
</div>
