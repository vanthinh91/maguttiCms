<div id="filemanager" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">

			<div class="modal-header d-flex justify-content-between" >
				<h4>File Manager</h4>
			    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

			</div>
			<div class="modal-action">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link bg-info" href="#tab-upload" id="file-manager-upload" data-bs-toggle="tab" role="tab" aria-controls="upload" aria-selected="true">Upload File</a>
					</li>
					<li class="nav-item">
						<a class="nav-link bg-success" href="#tab-images" id="file-manager-list" data-bs-toggle="tab" role="tab" aria-controls="list" aria-selected="false">Library</a>
					</li>
				</ul>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="tab-upload" class="tab-pane fade show active" role="tabpanel" aria-labelledby="file-manager-upload">
						<fieldset class="alert alert-info">
							<input name="upload-input" type="file" class="btn btn-primary">
							<div id="queue-modal" class="queue">{!!trans('admin.message.media_drag') !!}</div>
						</fieldset>
					</div>
					<div id="tab-images" class="tab-pane fade" role="tabpanel" aria-labelledby="file-manager-list">
						<div class="row">
							<div id="tab-images-gallery" class="col-md-8 col-12">
								<div class="loading text-center">
									<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
									<span class="sr-only">Loading...</span>
								</div>
							</div>
							<div id="sidebar-content" class="col-md-4 col-12">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer d-flex justify-content-end ">
				<button type="button" class="btn btn-success confirm-image" data-bs-dismiss="modal">{{icon('check')}} Select</button>
				<button type="button" class="btn btn-default reset-image">{{icon('undo')}} Reset selection</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{icon('times')}} Close</button>
				<input type="hidden" name="file-input" value="0">
				<input type="hidden" name="file-value" value="0">
			</div>
		</div>
	</div>
</div>
