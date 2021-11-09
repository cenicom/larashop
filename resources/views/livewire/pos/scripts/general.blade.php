<script>
	$('.tblscroll').nicescroll({
		cursorcolor: "#515365",
		cursorwidth: "30px",
		background: "rgba(20,20,20,0.3)",
		cursorborder: "0px",
		cursorborderradius: 3,
	})

	function confirm(id, eventName, text) {
        // body...
        Swal({
            title: 'CONFIRMAR BORRADO',
            text: text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
                // body...
            if(result.value){
                window.livewire.emit(eventName, id)
                Swal.close()
                }
            })
        }
    }

</script>
