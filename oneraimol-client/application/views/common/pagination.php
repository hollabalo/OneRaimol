<div class="span-24 last" id="gridBottom">
                    <div class="column span-9 left" id="recordLimit">
                        Show&nbsp;
                        <select id="limitpicker" name="showrecord" 
                                onchange="limit_record('<?php if(isset($refURL)) echo $refURL; ?>','<?php if(isset($searchmethod)) echo $searchmethod;?>' , '<?php if(isset($searchstring)) echo $searchstring; ?>')">
                            <?php 
                                if($recordcount != 'all') $recordcount = Helper_Helper::decrypt($recordcount); ?>
                            <option value="<?php echo Helper_Helper::encrypt('5'); ?>" <?php echo ($recordcount == '5') ? 'selected="selected"' : '' ?>>5</option>
                            <option value="<?php echo Helper_Helper::encrypt('10'); ?>" <?php echo ($recordcount == '10') ? 'selected="selected"' : '' ?>>10</option>
                            <option value="<?php echo Helper_Helper::encrypt('15'); ?>" <?php echo ($recordcount == '15') ? 'selected="selected"' : '' ?>>15</option>
                            <option value="<?php echo Helper_Helper::encrypt('20'); ?>" <?php echo ($recordcount == '20') ? 'selected="selected"' : '' ?>>20</option>
                            <option value="<?php echo Helper_Helper::encrypt('25'); ?>" <?php echo ($recordcount == '25') ? 'selected="selected"' : '' ?>>25</option>
                            <option value="<?php echo Helper_Helper::encrypt('30'); ?>" <?php echo ($recordcount == '30') ? 'selected="selected"' : '' ?>>30</option>
                            <option value="<?php echo Helper_Helper::encrypt('35'); ?>" <?php echo ($recordcount == '35') ? 'selected="selected"' : '' ?>>35</option>
                            <option value="<?php echo Helper_Helper::encrypt('40'); ?>" <?php echo ($recordcount == '40') ? 'selected="selected"' : '' ?>>40</option>
                            <option value="<?php echo Helper_Helper::encrypt('45'); ?>" <?php echo ($recordcount == '45') ? 'selected="selected"' : '' ?>>45</option>
                            <option value="<?php echo Helper_Helper::encrypt('50'); ?>" <?php echo ($recordcount == '50') ? 'selected="selected"' : '' ?>>50</option>
                            <option value="all" <?php echo ($recordcount == 'all') ? 'selected="selected"' : '' ?>>All</option>
                        </select>&nbsp; records per page
                    </div>
                    <?php if(isset($pageselector)) : ?>
                    <div class="column span-14 last pull-right" id="pagination">
                        <?php echo $pageselector ?>
                    </div>
                    <?php endif ?>
                </div>