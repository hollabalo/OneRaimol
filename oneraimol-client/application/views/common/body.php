<div class="column span-19 last" id="bodyContents">
            	<hr/>
            	
                <div class="block clearfix" id="bodyTop">
                	<div class="column span-16"><h2><?php if(isset($pageSelectionDesc)) echo $pageSelectionDesc ?></h2></div>
                        <div class="column span-5">&nbsp;</div>
                        <?php if(isset($searchaction)) : ?>
                        <div id="searchBox" class="column span-9">
                            <form method="post">
                                <input type="checkbox" id="matchkeyword"/>
                                <label for="matchkeyword">Exact</label>
                                <input class="dd-box" id="searchstring"/>
                                <input type="button" value="Search"/>
                            </form>
                        </div>
                        <?php endif ?>
                </div>
                
                <div id="bodyTextContents">
                    
                    <div class="pageDescription">
                        <?php if(isset($pageDescription)) echo $pageDescription ?>
                    </div>
                    <div class="pageNote"> 
                        <?php if(isset($pageNote)) echo $pageNote ?>
                    </div>
                    
                    <?php if(isset($bodyContents)) echo $bodyContents ?>

                
                </div>
                <div class="span-24 last">&nbsp;</div>
            </div>