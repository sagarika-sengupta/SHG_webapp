<div>
<h2 class="text-center text-primary">Deposit</h2>
        <div class="d-flex justify-content-center mt-4">
            <select class="form-select w-50" id="amount">
                <option selected disabled>Deposit Type</option>
                <option value="10">Reccuring Deposit</option>
                <option value="20">Fixed Deposit</option>

            </select>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-success px-5" onclick="proceed()">Proceed</button>
            <script>
                function proceed() {
                    var amount = document.getElementById('amount').value;
                    if (amount == '10') {
                        window.location.href = '/contribution';
                    }
                }
            </script>
        </div>
    </div>

</div>
