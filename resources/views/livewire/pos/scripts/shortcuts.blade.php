<script>
	var listener = new window.keypress.Listener();

	listener.simple_combo("f9", function() {
		// body...
		livewire.emit('saveSale')
	})

	listener.simple_combo("f8", function() {
		// body...
		document.getElementById('cash').value = ''
		document.getElementById('cash').focus()
	})

	listener.simple_combo("f4", function(){
		var total = parseFloat(document.getElementById('hiddenTotal').value)
		if (total > 0) {
			confirm(0, 'clearCart', '¿Seguro de Eliminar el Carrito?')
		}else{
			noty('Agregar Productos a la Venta')
		}
	})
</script>