<div id="addPossession-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box">
                <form id="society-form" action="{{}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="sales_id" id="sales-id"/>
                    <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <label for="payment_method">Enter Apartment ID</label>
                        <input type="search" name="apartmentID" class="form-control" placeholder="Enter Apartment ID"/>
                        <label for="comments">Comments</label>
                        <textarea type="text" name="comment" class="form-control" placeholder="comments"></textarea>
                        <button class="btn btn-primary btn-sm">Search User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
