<!DOCTYPE html>
<html>

<head>
	<title>Checkbox Example</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		#other-btn:hover {
			cursor: default;
		}

		#next-btn.btn-success:hover {
			cursor: pointer;
		}
	</style>

</head>

<body>
	<div class="container mt-4">
		<h1>Procedure of transaction</h1>
		<div style="margin-bottom: 20px;">
			<a href="#" id="next-btn" class="btn btn-warning">Next Step</a>
		</div>

		<div class="row">
			<div class="col-6 sm">
				<form method="POST" action="{{ route('transactions.store') }}">

					@csrf
					<table class="table">
						<tbody>
							<tr>
								<td>Expired Date?</td>
								<td>
									<input type="checkbox" name="expired" id="expired" class="my-checkbox">
							</tr>

							<tr>
								<td>Already Paid?</td>
								<td>
									<input type="checkbox" name="paid" id="paid" class="my-checkbox">
								</td>
							</tr>
							<input type="hidden" name="isFlagged" id="isFlagged" value="0">
						</tbody>
					</table>


					<div class="form-group row">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								Save
							</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			// disabled button
			var $submitButton = $('button[type=submit]');
			$submitButton.prop('disabled', true); // Disable the button by default

			$('input[type=checkbox]').change(function() {
				var expired = $('input[name=expired]').is(':checked');
				var paid = $('input[name=paid]').is(':checked');

				// Check if both checkboxes are checked
				var allChecked = expired && paid;

				// Enable or disable the submit button based on whether both checkboxes are checked
				$submitButton.prop('disabled', !allChecked);
			});

			
			// save to db
			$('input[type=checkbox]').change(function() {
				var expired = $('input[name=expired]').is(':checked') ? '1' : '0';
				var paid = $('input[name=paid]').is(':checked') ? '1' : '0';

				$.ajax({
					type: 'POST',
					url: '{{ route("transactions.update-flagged") }}',
					data: {
						_token: '{{ csrf_token() }}',
						expired: expired,
						paid: paid
					},
					success: function(data) {
						console.log(data);
					}
				});
			});
		});
	</script>
</body>

</html>