<div class="span-24 last" id="gridBottom">
                    <div class="column span-6 left" id="recordLimit">
                        Show&nbsp;
                        <select id="limitpicker" name="showrecord" 
                                onchange="limit_record('<?php if(isset($refURL)) echo $refURL; ?>','<?php if(isset($searchmethod)) echo $searchmethod;?>')">
                            <?php 
                                if($recordcount != 'all') $recordcount = Helper_Helper::decrypt($recordcount); ?>
                            <option value="<?php echo Helper_Helper::encrypt('5'); ?>" <?php echo ($recordcount == '5') ? 'selected="true"' : '' ?>>5</option>
                            <option value="<?php echo Helper_Helper::encrypt('10'); ?>" <?php echo ($recordcount == '10') ? 'selected="true"' : '' ?>>10</option>
                            <option value="<?php echo Helper_Helper::encrypt('15'); ?>" <?php echo ($recordcount == '15') ? 'selected="true"' : '' ?>>15</option>
                            <option value="<?php echo Helper_Helper::encrypt('20'); ?>" <?php echo ($recordcount == '20') ? 'selected="true"' : '' ?>>20</option>
                            <option value="<?php echo Helper_Helper::encrypt('25'); ?>" <?php echo ($recordcount == '25') ? 'selected="true"' : '' ?>>25</option>
                            <option value="<?php echo Helper_Helper::encrypt('30'); ?>" <?php echo ($recordcount == '30') ? 'selected="true"' : '' ?>>30</option>
                            <option value="<?php echo Helper_Helper::encrypt('35'); ?>" <?php echo ($recordcount == '35') ? 'selected="true"' : '' ?>>35</option>
                            <option value="<?php echo Helper_Helper::encrypt('40'); ?>" <?php echo ($recordcount == '40') ? 'selected="true"' : '' ?>>40</option>
                            <option value="<?php echo Helper_Helper::encrypt('45'); ?>" <?php echo ($recordcount == '45') ? 'selected="true"' : '' ?>>45</option>
                            <option value="<?php echo Helper_Helper::encrypt('50'); ?>" <?php echo ($recordcount == '50') ? 'selected="true"' : '' ?>>50</option>
                            <option value="all" <?php echo ($recordcount == 'all') ? 'selected="true"' : '' ?>>All</option>
                        </select>&nbsp; records per page
                    </div>
                    <?php if(isset($pageselector)) : ?>
                    <div class="column span-12 last" id="pagination">
                        <div class="last">
                        <?php echo $pageselector ?>
                        </div>
                    </div>
                    <?php endif ?>
                </div>