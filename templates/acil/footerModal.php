<?php

    if(isset($formModal))
    {
        echo "
                    </div>
                        <div class='modal-footer'>
                            $contentModalFooter
                        </div>
                    </form>
                    </div>
                </div>
            </div>";
    }
    else
    {
        echo "
                    </div>
                        <div class='modal-footer'>
                            $contentModalFooter
                        </div>
                    </div>
                </div>
            </div>";
    }

?>