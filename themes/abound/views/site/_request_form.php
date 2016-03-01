        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title' => '<span class="icon-picture"></span>Request Form',
                'titleCssClass' => ''
            ));
        ?>
        <?php echo CHtml::beginForm(array('/site/clientRequest'), 'POST',array('class'=>'well')); ?>
            <?php echo CHtml::hiddenField('clientUpload', 'clientUpload'); ?>
            <?php echo CHtml::hiddenField('fileName', null, array('id'=>'fileName')); ?>
            <label>Upload the mobile numbers</label>
            <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id' => 'uploadFile',
                    'config' => array(
                        'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                        'action' => Yii::app()->createUrl('site/upload'),
                        'allowedExtensions' => array("csv",'txt', 'xlsx', 'xls'),
                        //array("jpg","jpeg","gif","exe","mov" and etc...
                        'sizeLimit' => 10 * 1024 * 1024,
                        // maximum file size in bytes
                        'onComplete' => "js:
                            function(id, fileName, responseJSON){ 
                                document.getElementById('fileName').value = fileName;
                            }
                        ",
                        'messages' => array(
                            'typeError' => "{file} has invalid extension. Only {extensions} are allowed.",
                            'sizeError' => "{file} is too large, maximum file size is {sizeLimit}.",
                            'minSizeError' => "{file} is too small, minimum file size is {minSizeLimit}.",
                            'emptyError' => "{file} is empty, please select files again without it.",
                            'onLeave' => "The files are being uploaded, if you leave now the upload will be cancelled."
                        ),
                        // 'showMessage' => "js:function(message){ alert(message);}"
                    )
                )); 
            ?>
            <label>Select sound file : </label>
            <?php 
            
                echo CHtml::dropDownList('soundFileName', null, array(
                    'Boiler'=>'HCCRO',
                    'Car_Finance'=>'Car Finance',
                    'Debt_3000'=>'Debt - 3000',
                    'Debt_5000'=>'Debt - 5000',
                    'FlightDelay'=>'Flight Delay',
                    'Funeral'=>'Funeral',
                    'PBA'=>'PBA',
                    'PI'=>'PI',
                    'MISSOLD_PENSION'=>'Mis-Sold Pension',
                    // 'ECO'=>'Eco',
                ), array('id'=>'soundFileName','prompt'=>'Please select a sound file')); 
            ?>
            <button type='button' onclick='playSoundFile(this);' style="margin-top: -10px;">
                <span id="playIcon" class='icon icon-play'></span>
            </button>
            <button type='button' onclick='stopAllSoundFile(this);' style="margin-top: -10px;">
                <span class='icon icon-stop'></span>
            </button>
            <button type="submit" class="btn btn-primary btn-large" style="margin-top: -14px;margin-left: 7px;">Submit</button>
        <?php echo CHtml::endForm(); ?>
        
        <?php $this->endWidget(); ?>