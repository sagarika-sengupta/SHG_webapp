<div>
<div class="container mt-5">
        <h2 class="text-center">Loan Application Form</h2>
        <form>
            <div class="mb-3">
                <label for="loanAmount" class="form-label">Loan Amount</label>
                <input type="number" class="form-control" id="loanAmount" placeholder="Enter loan amount">
            </div>
            
            <div class="mb-3">
                <label for="loanTerm" class="form-label">Term for Loan</label>
                <select class="form-select" id="loanTerm">
                    <option value="6">6 Months</option>
                    <option value="12">12 Months</option>
                    <option value="24">24 Months</option>
                    <option value="36">36 Months</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="loanReason" class="form-label">Reason</label>
                <select class="form-select" id="loanReason">
                    <option value="home">Home</option>
                    <option value="business">Business</option>
                    <option value="personal">Personal</option>
                    <option value="others">Others</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="emiStructure" class="form-label">EMI Structure</label>
                <select class="form-select" id="emiStructure">
                    <option value="fixed">Fixed EMI</option>
                    <option value="reducing">Reducing EMI</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Apply Now</button>
        </form>
    </div>
</div>
