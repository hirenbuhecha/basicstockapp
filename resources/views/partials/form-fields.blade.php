<div class="mb-3">
    <label for="company_symbol" class="form-label">Company Symbol:</label>
    <input type="text" class="form-control" placeholder="Company Symbol" name="company_symbol" required>
</div>

<div class="mb-3">
    <label for="start_date" class="form-label">Start Date:</label>
    <input type="text" class="form-control" id="start_date" name="start_date" required
           pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-mm-dd">
</div>

<div class="mb-3">
    <label for="end_date" class="form-label">End Date:</label>
    <input type="text" class="form-control" id="end_date" name="end_date" required
           pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-mm-dd">
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" placeholder="Email" name="email" required>
</div>

<button type="submit" class="btn btn-primary">Submit</button>