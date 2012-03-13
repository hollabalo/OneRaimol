$( document ).ready(
    function() {
        $( '#pbt-form' ).validate(
            {
                rules : {
                    product_code            : 'required',
                    blending_time_required  : 'required',
                    performed_by            : 'required',
                    date_produced           : 'required',
                    py_theoretical          : 'required',
                    py_actual               : 'required',
                    variance                : 'required',
                    machine_desc            : 'required',
                    blending_time           : 'required'
                },
                messages : {
                    product_code            : message.required,
                    blending_time_required  : message.required,
                    performed_by            : message.required,
                    date_produced           : message.required,
                    py_theoretical          : message.required,
                    py_actual               : message.required,
                    variance                : message.required,
                    machine_desc            : message.required,
                    blending_time           : message.required
                },
                submitHandler : function() {
                    submit_pbt();
                },
                errorPlacement: function( error, element ) {
                    element.closest('td')
                           .find('span:last')
                           .append( error );
                }
            }
        );
    }
);
  