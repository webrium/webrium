@section('content')
<div class="space-y-6" z-if="!isLoading">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
      <h2 class="text-2xl font-bold text-base-content">
        {{ formData.id ? 'Edit Category' : 'Add New Category' }}
      </h2>
      <p class="text-base-content/60 mt-1">
        {{ formData.id ? 'Update category information' : 'Create a new category for your products or posts' }}
      </p>
    </div>
    <a href="/admin/categories" class="btn btn-ghost gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
      </svg>
      Back to Categories
    </a>
  </div>

  <form id="category-form" class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Main Information -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Basic Info Card -->
        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h3 class="card-title mb-4">Basic Information</h3>
            
            <!-- Name -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Category Name <span class="text-error">*</span></span>
              </label>
              <input 
                type="text" 
                name="name"
                placeholder="e.g., Electronics" 
                class="input input-bordered w-full"
                :class="{ 'input-error': errors.name }"
                z-model="formData.name"
                @input="generateSlug"
                required
              />
              <label class="label" z-if="errors.name">
                <span class="label-text-alt text-error">{{ errors.name }}</span>
              </label>
            </div>

            <!-- Slug -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Slug <span class="text-error">*</span></span>
              </label>
              <input 
                type="text" 
                name="slug"
                placeholder="electronics" 
                class="input input-bordered w-full font-mono text-sm"
                :class="{ 'input-error': errors.slug }"
                z-model="formData.slug"
                required
              />
              <label class="label">
                <span class="label-text-alt" z-if="!errors.slug">URL-friendly version of the name</span>
                <span class="label-text-alt text-error" z-if="errors.slug">{{ errors.slug }}</span>
              </label>
            </div>

            <!-- Description -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Description</span>
              </label>
              <textarea 
                name="description"
                class="textarea textarea-bordered h-24" 
                placeholder="Brief description of the category..."
                z-model="formData.description"
                maxlength="500"
              ></textarea>
              <label class="label">
                <span class="label-text-alt">{{ formData.description.length }} / 500 characters</span>
              </label>
            </div>
          </div>
        </div>

        <!-- SEO Settings Card -->
        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h3 class="card-title mb-4">SEO Settings</h3>
            
            <!-- Meta Title -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Meta Title</span>
              </label>
              <input 
                type="text" 
                name="meta_title"
                placeholder="SEO title for search engines" 
                class="input input-bordered w-full"
                z-model="formData.meta_title"
                maxlength="60"
              />
              <label class="label">
                <span class="label-text-alt">{{ formData.meta_title.length }} / 60 characters</span>
              </label>
            </div>

            <!-- Meta Description -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Meta Description</span>
              </label>
              <textarea 
                name="meta_description"
                class="textarea textarea-bordered h-20" 
                placeholder="SEO description for search engines..."
                z-model="formData.meta_description"
                maxlength="160"
              ></textarea>
              <label class="label">
                <span class="label-text-alt">{{ formData.meta_description.length }} / 160 characters</span>
              </label>
            </div>

            <!-- Meta Keywords -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Meta Keywords</span>
              </label>
              <input 
                type="text" 
                name="meta_keywords"
                placeholder="keyword1, keyword2, keyword3" 
                class="input input-bordered w-full"
                z-model="formData.meta_keywords"
              />
              <label class="label">
                <span class="label-text-alt">Separate keywords with commas</span>
              </label>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
        <!-- Publishing Card -->
        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h3 class="card-title mb-4">Publishing</h3>
            
            <!-- Status -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Status</span>
              </label>
              <select 
                name="status"
                class="select select-bordered w-full"
                z-model="formData.status"
              >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>

            <!-- Parent Category -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Parent Category</span>
              </label>
              <select 
                name="parent_id"
                class="select select-bordered w-full"
                z-model="formData.parent_id"
              >
                <option value="">None (Root Category)</option>
                <option 
                  z-for="parent in parentCategories" 
                  :key="parent.id"
                  :value="parent.id"
                  :disabled="parent.id === formData.id"
                >
                  {{ parent.name }}
                </option>
              </select>
              <label class="label">
                <span class="label-text-alt">Select a parent category to create a sub-category</span>
              </label>
            </div>

            <!-- Order -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Display Order</span>
              </label>
              <input 
                type="number" 
                name="order"
                min="0"
                placeholder="0" 
                class="input input-bordered w-full"
                z-model="formData.order"
              />
              <label class="label">
                <span class="label-text-alt">Lower numbers appear first</span>
              </label>
            </div>
          </div>
        </div>

        <!-- Category Image Card -->
        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h3 class="card-title mb-4">Category Image</h3>
            
            <!-- Image Preview -->
            <div z-if="imagePreview || formData.image" class="mb-4">
              <img 
                :src="imagePreview || formData.image" 
                alt="Category image"
                class="w-full h-48 object-cover rounded-lg"
              />
              <button 
                type="button"
                class="btn btn-sm btn-error btn-outline w-full mt-2"
                @click="removeImage"
              >
                Remove Image
              </button>
            </div>

            <!-- Upload Button -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Upload Image</span>
              </label>
              <input 
                type="file" 
                accept="image/*"
                class="file-input file-input-bordered w-full"
                @change="handleImageUpload"
              />
              <label class="label">
                <span class="label-text-alt">Max size: 2MB</span>
              </label>
            </div>

            <!-- Image URL (alternative) -->
            <div class="divider text-xs">OR</div>
            
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Image URL</span>
              </label>
              <input 
                type="url" 
                name="image"
                placeholder="https://example.com/image.jpg" 
                class="input input-bordered w-full"
                z-model="formData.image"
              />
            </div>
          </div>
        </div>

        <!-- Icon Card -->
        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h3 class="card-title mb-4">Icon (Optional)</h3>
            
            <!-- Icon Input -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Icon Class</span>
              </label>
              <input 
                type="text" 
                name="icon"
                placeholder="e.g., fas fa-laptop" 
                class="input input-bordered w-full"
                z-model="formData.icon"
              />
              <label class="label">
                <span class="label-text-alt">FontAwesome or similar icon class</span>
              </label>
            </div>

            <!-- Icon Preview -->
            <div z-if="formData.icon" class="flex items-center justify-center p-4 bg-base-200 rounded-lg">
              <i :class="formData.icon" class="text-4xl"></i>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="card bg-base-100 shadow-xl">
          <div class="card-body space-y-2">
            <button 
              type="submit" 
              class="btn btn-primary w-full"
              :disabled="isSubmitting"
            >
              <span z-if="!isSubmitting">
                {{ formData.id ? 'Update Category' : 'Create Category' }}
              </span>
              <span z-else class="loading loading-spinner"></span>
            </button>

            <button 
              type="button" 
              class="btn btn-ghost w-full"
              @click="resetForm"
            >
              Reset Form
            </button>

            <a 
              href="/admin/categories" 
              class="btn btn-outline w-full"
            >
              Cancel
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Loading State -->
<div z-if="isLoading" class="flex items-center justify-center min-h-screen">
  <span class="loading loading-spinner loading-lg"></span>
</div>

<!-- Success Toast -->
<div z-if="showSuccessToast" class="toast toast-top toast-end">
  <div class="alert alert-success">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span>{{ successMessage }}</span>
  </div>
</div>

<!-- Error Toast -->
<div z-if="showErrorToast" class="toast toast-top toast-end">
  <div class="alert alert-error">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span>{{ errorMessage }}</span>
  </div>
</div>
@endsection