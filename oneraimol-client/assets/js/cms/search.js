$( document ).ready(
    function() {
        $( '#search-form' ).validate(
            {
                submitHandler : function() {
                    search(); 
                }
            }
        );
    }
);