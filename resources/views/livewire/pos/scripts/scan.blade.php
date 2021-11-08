<script>

	try{
		onScan.attachTo(document, {
		suffixKeyCodes: [13],
		onScan: function(barcode) {
			// body...
			console.Log(barcode)
			window.livewire.emit('scan-code', barcode)
		},
		onScanError: function(e) {
			console.Log(e)
			}
		})

		console.Log('Scanner Ready!')

	}catch(e){
		console.Log('Error de Lectura: ', e)
	}
	
</script>