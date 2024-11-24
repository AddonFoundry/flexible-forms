<template>
	<stack name="inline-editor" v-if="isEditing" @closed="editorClosed()" half>
		<div class="flexible-forms h-full bg-gray-300 overflow-scroll">
			<header
				class="flex items-center sticky top-0 inset-x-0 bg-white shadow px-8 py-2 z-1 h-13">
				<h1 class="flex-1 flex items-center text-xl">
					{{ currentField.config.display }}
					<small
						class="badge-pill bg-gray-100 ml-4 border border-gray-700 dark:border-gray-900 text-xs text-gray-700 font-medium leading-none flex items-center">
            <svg-icon class="text-gray-800 dark:text-dark-150 rtl:ml-2 ltr:mr-2 h-4 w-4 flex-none" :name="currentField.icon.startsWith('<svg') ? currentField.icon : `light/${currentField.icon}`" default="light/generic-field" />
						{{ dirtyField.config.type }}
					</small>
				</h1>
				<button
					@click="editorClosed()"
					class="text-gray-700 hover:text-gray-800 mr-6 text-sm">
					Cancel
				</button>
				<button @click.prevent="applyChanges()" class="btn-primary">Apply</button>
			</header>
      <!-- Common -->
      <div class="publish-sections-section mt-6 mb-6">
        <div class="p-0 m-4 card">
          <header class="publish-section-header @container"><div class="publish-section-header-inner"><label class="text-base font-semibold">Common</label></div></header>
          <div class="publish-fields @container">
            <!-- Display Label -->
            <div class="form-group publish-field publish-field__display field_display-fieldtype config-field">
              <div class="field-inner">
                <label for="field_display" class="publish-field-label">
                  <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Display Label</span>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path></svg>
                  </button>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path></svg>
                  </button>
                </label
                ><div class="help-block -mt-2">
                  <p>The form field's label shown above the input.</p>
                </div>
              </div>
              <div class="flex items-center">
                <div class="input-group">
                  <input id="field_display" name="display" type="text" class="input-text" v-model="dirtyField.config.display">
                  <button v-if="dirtyField.config.hide_display" @click="toggleVisibility('off')" v-tooltip="'Label hidden'" class="input-group-append flex items-center v-popper--has-tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-100"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M.91 12.59a1 1 0 0 1 0-1.18C2.11 9.8 5.9 5.5 12 5.5s9.89 4.3 11.09 5.91a1 1 0 0 1 0 1.18c-1.2 1.61-5 5.91-11.09 5.91S2.11 14.2.91 12.59Z"></path><path d="M7.76 13.5A4.38 4.38 0 0 1 7.5 12 4.49 4.49 0 0 1 12 7.5a4.38 4.38 0 0 1 1.5.26M15.18 8.82a4.5 4.5 0 1 1-6.36 6.36M17 7 6.75 17.25"></path></g></svg>
                  </button>
                  <button v-else @click="toggleVisibility('on')" v-tooltip="'Label visible'" class="input-group-append flex items-center v-popper--has-tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-500"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M.91 12.59a1 1 0 0 1 0-1.18C2.11 9.8 5.9 5.5 12 5.5s9.89 4.3 11.09 5.91a1 1 0 0 1 0 1.18c-1.2 1.61-5 5.91-11.09 5.91S2.11 14.2.91 12.59Z"></path><path d="M7.76 13.5A4.38 4.38 0 0 1 7.5 12 4.49 4.49 0 0 1 12 7.5a4.38 4.38 0 0 1 1.5.26M15.18 8.82a4.5 4.5 0 1 1-6.36 6.36M17 7 6.75 17.25"></path></g></svg>
                  </button>
                </div>
              </div>
            </div>
            <!-- Handle -->
            <div class="form-group publish-field publish-field__handle slug-fieldtype config-field">
              <div class="field-inner">
                <label for="field_handle" class="publish-field-label">
                    <span class="mr-1 v-popper--has-tooltip">Handle</span><i class="required mr-1">*</i>
                    <button class="outline-none" style="display: none;">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                      </svg>
                    </button>
                    <button class="outline-none" style="display: none;">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                      </svg>
                    </button>
                </label>
                <div class="help-block -mt-2">
                    <p>The field's template variable.</p>
                </div>
              </div>
              <div>
                <div class="flex items-center">
                    <div class="input-group">
                      <input id="field_handle" name="text_field" type="text" class="input-text font-mono text-xs" v-model="dirtyField.handle">
                      <button @click="updateHandle()" class="input-group-append items-center flex v-popper--has-tooltip">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M.713 10.34 3.5 14.49l3.205-3.838"></path>
                                <path d="M3.489 14.439a8.947 8.947 0 0 1 6.554-10.727 8.492 8.492 0 0 1 8.325 2.641m4.917 7.289L20.498 9.49l-3.205 3.838"></path>
                                <path d="M20.509 9.543a8.948 8.948 0 0 1-6.554 10.727 8.5 8.5 0 0 1-8.325-2.641"></path>
                                <path d="M10 11.991a2 2 0 1 0 4 0 2 2 0 1 0-4 0Z"></path>
                            </g>
                          </svg>
                      </button>
                    </div>
                </div>
              </div>
              <p v-if="handleErrorMessage" class="help-block text-red-500 mt-2 mb-0">{{ handleErrorMessage }}</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Input Behaviour -->
      <div class="publish-sections-section mb-6">
        <div class="p-0 m-4 card">
          <header class="publish-section-header @container"><div class="publish-section-header-inner"><label class="text-base font-semibold">Input Behavior</label></div></header>
          <div class="publish-fields @container">
            <!-- Input Type -->
            <div v-if="currentField.fieldtype == 'text'" class="form-group publish-field publish-field__input_type select-fieldtype config-field">
              <div class="field-inner">
                <label for="field_input_type" class="publish-field-label">
                  <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Input Type</span>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                    </svg>
                  </button>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                    </svg>
                  </button>
                </label>
                <div class="help-block -mt-2">
                  <p>Set the HTML5 input type.</p>
                </div>
              </div>
              <div class="btn-group flex">
                <button @click="setInputType('')" class="btn btn-sm flex w-full justify-center items-center" :class="{ 'active': dirtyField.config.input_type == '' || dirtyField.config.input_type == null }">text</button>
                <button @click="setInputType('email')" class="btn btn-sm flex w-full justify-center items-center" :class="{ 'active': dirtyField.config.input_type == 'email' }">email</button>
                <button @click="setInputType('tel')" class="btn btn-sm flex w-full justify-center items-center" :class="{ 'active': dirtyField.config.input_type == 'tel' }">tel</button>
                <button @click="setInputType('date')" class="btn btn-sm flex w-full justify-center items-center" :class="{ 'active': dirtyField.config.input_type == 'date' }">date</button>
              </div>
            </div>
            <!-- Placeholder -->
            <div class="form-group publish-field publish-field__placeholder text-fieldtype config-field">
              <div class="field-inner">
                <label for="field_placeholder" class="publish-field-label">
                  <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Placeholder</span>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                    </svg>
                  </button>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                    </svg>
                  </button>
                </label>
                <div class="help-block -mt-2">
                  <p>The placeholder text for this input.</p>
                </div>
              </div>
              <div class="flex items-center">
                <div class="input-group">
                  <input id="field_placeholder" name="placeholder" type="text" class="input-text" v-model="dirtyField.config.placeholder">
                </div>
              </div>
            </div>
            <!-- Default Value -->
            <div class="form-group publish-field publish-field__default text-fieldtype config-field">
              <div class="field-inner">
                <label for="field_default" class="publish-field-label">
                  <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Default Value</span>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                    </svg>
                  </button>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                    </svg>
                  </button>
                </label>
                <div class="help-block -mt-2">
                  <p>The value to be inserted whenever this field is empty.</p>
                </div>
              </div>
              <div class="flex items-center">
                <div class="input-group">
                  <input id="field_default" name="default" type="text" class="input-text" v-model="dirtyField.config.default">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Options -->
      <div v-if="dirtyField.fieldtype === 'select' || dirtyField.fieldtype === 'checkboxes' || dirtyField.fieldtype === 'radio'" class="publish-sections-section mb-6">
        <div class="p-0 m-4 card">
          <header class="publish-section-header @container"><div class="publish-section-header-inner"><label class="text-base font-semibold">Options</label></div></header>
          <div class="publish-fields @container">
            <!-- Options -->
            <div class="form-group publish-field publish-field__options array-fieldtype config-field">
              <div class="field-inner">
                <label for="field_options" class="publish-field-label">
                  <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Options</span>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                    </svg>
                  </button>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                    </svg>
                  </button>
                </label>
                <div class="help-block -mt-2">
                  <p>Set the keys and their optional labels.</p>
                </div>
              </div>
              <div class="array-fieldtype-container">
                <div class="table-field">
                  <table v-if="options && options.length > 0" class="table-fieldtype-table">
                    <thead>
                      <tr>
                        <th class="grid-drag-handle-header"></th>
                        <th class="w-1/4">Key</th>
                        <th>Label (Optional)</th>
                        <th class="row-controls"></th>
                      </tr>
                    </thead>
                    <tbody tabindex="0" class="sortable-options" ref="sortableContainer">
                      <tr v-for="(option, index) in options" :key="option.sortOrder" class="sortable-row">
                        <td class="sortable-handle table-drag-handle"></td>
                        <td><input type="text" class="input-text font-bold" v-model="option.key"></td>
                        <td><input type="text" class="input-text" v-model="option.label"></td>
                        <td class="row-controls">
                          <a @click="removeOption(index)" class="inline opacity-25 text-lg antialiased hover:opacity-75">×</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <button @click="addOption()" class="btn">Add Option</button>
                </div>
              </div>
              <p v-if="errorMessage" class="help-block text-red-500 mt-2 mb-0">{{ errorMessage }}</p>
            </div>
            <!-- Checkbox and radio inline toggle -->
            <div v-if="dirtyField.fieldtype === 'checkboxes' || dirtyField.fieldtype === 'radio'" class="form-group publish-field publish-field__inline toggle-fieldtype config-field">
              <div class="field-inner">
                <label for="field_inline" class="publish-field-label">
                  <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Inline</span>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                    </svg>
                  </button>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                    </svg>
                  </button>
                </label>
                <div class="help-block -mt-2">
                  <p>Show the checkboxes in a row.</p>
                </div>
              </div>
              <div class="toggle-fieldtype-wrapper">
                <button @click="toggleInline()" type="button" :aria-pressed="hasInline()" aria-label="Toggle Button" class="toggle-container" :class="hasInline() ? 'on' : ''">
                    <div class="toggle-slider"><div tabindex="0" class="toggle-knob"></div>
                  </div>
                </button>

              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- Asset Field -->
      <div v-if="dirtyField.fieldtype === 'assets'" class="publish-sections-section mb-6 relative z-1">
        <div class="p-0 m-4 card">
          <header class="publish-section-header @container"><div class="publish-section-header-inner"><label class="text-base font-semibold">Assets Field</label></div></header>
          <div class="publish-fields @container">
            <!-- Max Files -->
            <div class="form-group publish-field publish-field__max_files integer-fieldtype config-field">
              <div class="field-inner">
                  <label for="field_max_files" class="publish-field-label">
                      <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Max Files</span>
                      <button class="outline-none" style="display: none;">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                          </svg>
                      </button>
                      <button class="outline-none" style="display: none;">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                          </svg>
                      </button>
                  </label>
                  <div class="help-block -mt-2">
                      <p>Set a maximum number of selectable assets.</p>
                  </div>
              </div>
              <div class="flex items-center">
                  <div class="input-group">
                      <input id="field_max_files" name="max_files" type="number" min="1" class="input-text" v-model="dirtyField.config.max_files">
                  </div>
              </div>
            </div>
            <!-- Container -->
            <div class="form-group publish-field publish-field__container relationship-fieldtype config-field">
              <div class="field-inner">
                  <label for="field_container" class="publish-field-label">
                      <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Container</span>
                      <i class="required rtl:ml-1 ltr:mr-1">*</i>
                      <button class="outline-none" style="display: none;">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                          </svg>
                      </button>
                      <button class="outline-none" style="display: none;">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                          </svg>
                      </button>
                  </label>
                  <div class="help-block -mt-2">
                      <p>Choose which asset container to use for this field.</p>
                  </div>
              </div>
              <div class="relationship-input">
                <div data-v-c80a132c="">
                  <div data-v-c80a132c="" dir="auto" class="v-select vs--single vs--searchable" :class="{ 'vs--open': toggleContainer }">
                    <div id="vs14__combobox" role="combobox" aria-expanded="false" aria-owns="vs14__listbox" aria-label="Search for option" class="vs__dropdown-toggle">
                      <div class="vs__selected-options" @click="toggleContainer = !toggleContainer">
                        <!-- Placeholder for selected option (if any) -->
                        <input aria-autocomplete="list" aria-labelledby="vs14__combobox" aria-controls="vs14__listbox" type="search" autocomplete="off" class="vs__search" :value="captilize(dirtyField.config.container)" placeholder="Choose..." readonly>
                      </div>
                      <div class="vs__actions">
                        <button v-if="dirtyField.config.container" @click="clearContainer()" type="button" title="Clear Selected" aria-label="Clear Selected" class="vs__clear"><span>×</span></button>
                        <span class="toggle vs__open-indicator" role="presentation" @click="toggleContainer = !toggleContainer">
                          <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 20 20">
                            <path fill="currentColor" d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                          </svg>
                        </span>
                        <div class="vs__spinner" style="display: none;">Loading...</div>
                      </div>
                      <ul v-if="containers && containers.length > 0 && toggleContainer" role="listbox" tabindex="-1" class="vs__dropdown-menu">
                        <li 
                          v-for="(container, index) in containers" 
                          :key="container.id" 
                          @click="setContainer(container.id)" 
                          class="vs__dropdown-option"
                          :class="{
                            'vs__dropdown-option--highlight': highlightedIndex === index,
                            'vs__dropdown-option--selected': container.id == dirtyField.config.container
                          }"
                          @mouseover="highlightedIndex = index"
                          @mouseleave="highlightedIndex = null"
                        >
                          {{ captilize(container.title) }}
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
           </div>
          </div>
        </div>
      </div>
      <!-- Validation -->
      <div class="publish-sections-section">
        <div class="p-0 m-4 card">
          <header class="publish-section-header @container"><div class="publish-section-header-inner"><label class="text-base font-semibold">Validation</label></div></header>
          <div class="publish-fields @container">
            <!-- Required Validation Toggle -->
            <div class="form-group publish-field publish-field__default text-fieldtype config-field">
              <div class="field-inner">
                <label for="field_default" class="publish-field-label">
                  <span class="rtl:ml-1 ltr:mr-1 v-popper--has-tooltip">Required</span>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.082 9.5A4.47 4.47 0 0 0 6.75 8h-1.5a4.5 4.5 0 0 0 0 9h1.5a4.474 4.474 0 0 0 3.332-1.5m3.836-6A4.469 4.469 0 0 1 17.25 8h1.5a4.5 4.5 0 1 1 0 9h-1.5a4.472 4.472 0 0 1-3.332-1.5M6.75 12.499h10.5"></path>
                    </svg>
                  </button>
                  <button class="outline-none" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 rtl:ml-1.5 ltr:mr-1.5 mb-1 text-gray-600 v-popper--has-tooltip">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 15.749h1.875A3.963 3.963 0 0 0 22.5 12h0a3.962 3.962 0 0 0-4.125-3.75H16.5m-9 7.499H5.625A3.963 3.963 0 0 1 1.5 12h0a3.963 3.963 0 0 1 4.125-3.75H7.5M12 5.249v-4.5m-3 4.5-1.5-1.5m7.5 1.5 1.5-1.5m-4.5 15v4.5m-3-4.5-1.5 1.5m7.5-1.5 1.5 1.5"></path>
                    </svg>
                  </button>
                </label>
                <div class="help-block -mt-2">
                  <p>Control whether or not this field is required.</p>
                </div>
              </div>
              <div class="flex items-center">
                <div class="">
                  <button @click="toggleRequired()" type="button" :aria-pressed="hasRequired()" aria-label="Toggle Button" class="toggle-container" :class="hasRequired() ? 'on' : ''">
                      <div class="toggle-slider"><div tabindex="0" class="toggle-knob"></div>
                    </div>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		</div>
	</stack>
</template>

<script>

import {Sortable, Plugins} from '@shopify/draggable';

export default {
  data() {
    return {
      dirtyField: null,
      options: [],
      errorMessage: '',
      handleErrorMessage: '',
      sortableFields: null,
      fieldValue: {},
      containers: {},
      toggleContainer: false,
      highlightedIndex: null,
      reservedWords:[
      'content_type',
      'count',
      'elseif',
      'endif',
      'endunless',
      'id',
      'if',
      'length',
      'reference',
      'resource',
      'save',
      'status',
      'unless',
      'value',
      'message',
      'messages'
      ]
    }
  },
  props: ['blueprint', 'currentField', 'isEditing'],
  mounted() {
    console.log(JSON.parse(JSON.stringify(this.currentField)));
  },
  watch: {
    currentField() {
      this.dirtyField = JSON.parse(JSON.stringify(this.currentField));
      console.log(this.dirtyField);
      if(this.dirtyField.fieldtype == 'assets') {
        this.assetData();  
      }
      this.setupOptions();
    },
  },
  methods: {
    toggleVisibility(type) {
      if(type == 'on') {
        if(this.dirtyField.config.hide_display) {
          this.dirtyField.config.hide_display = true;
        } else {
          this.$set(this.dirtyField.config, 'hide_display', true);
        }
      } else {
        this.dirtyField.config.hide_display = false;
      }
    },
    applyChanges() {
      if(this.options && this.options.length > 0) {
        // Check for empty keys
        for (let option of this.options) {
          if (!option.key.trim()) {
            this.errorMessage = "All options must have keys.";
            this.$toast.error(__('The given data was invalid.'));
            return;
          }
        }          
        // Check for duplicate keys
        const keys = this.options.map(option => option.key);
        const uniqueKeys = new Set(keys);
        if (uniqueKeys.size !== keys.length) {
          this.errorMessage = "All keys must be unique.";
          this.$toast.error(__('The given data was invalid.'));
          return;
        }
        this.dirtyField.config.options = this.arrayToObject(this.options);
      } else {
        this.dirtyField.config.options = null;
      }
      if(this.reservedWords.includes(this.dirtyField.handle)) {
        this.handleErrorMessage = "Field handle cannot be a reserved word.";
        this.$toast.error(__('The given data was invalid.'));
        return;
      }
      this.errorMessage = '';
      this.handleErrorMessage = '';
      this.$emit('fieldModified', { ...this.dirtyField });
      this.$events.$emit('event.close-stack');
    },
    editorClosed() {
      this.errorMessage = '';
      this.handleErrorMessage = '';
      this.$events.$emit('event.close-stack');
    },
    updateHandle() {
      this.dirtyField.handle = this.dirtyField.config.display.toLowerCase().replace(/[^a-z0-9_]/gi, '_');
    },
    setInputType(type) {
      this.dirtyField.config.input_type = type;
    },
    hasRequired() {
      if (this.dirtyField && this.dirtyField.config && Array.isArray(this.dirtyField.config.validate)) {
        return this.dirtyField.config.validate.includes('required');
      }
      return false;
    },
    toggleRequired() {
      if(this.hasRequired()) {
        this.dirtyField.config.validate = this.dirtyField.config.validate.filter(item => item !== 'required');
      } else {
        if (!Array.isArray(this.dirtyField.config.validate)) {
          this.$set(this.dirtyField.config, 'validate', []);
        }
        this.dirtyField.config.validate.push('required');
      }
      this.hasRequired();
    },
    hasInline() {
      if (this.dirtyField.config && this.dirtyField.config.inline == true) {
        return true;
      }
      return false;
    },
    toggleInline() {
      if(this.hasInline()) {
        this.dirtyField.config.inline = false;
      } else {
        if (this.dirtyField.config.inline) {
          this.dirtyField.config.inline = true;
        } else {
          this.$set(this.dirtyField.config, 'inline', true);
        }
      }
      this.hasInline();
    },
    setupOptions() {

      this.options = [];

      if (this.dirtyField.config.options) {
        this.options = this.objectToArray(this.dirtyField.config.options);
      }

      this.$nextTick(() => {
        this.$nextTick(() => {
          if (this.options && this.options.length > 0) {
            this.makeFieldsSortable();
          }
        });
      });

    },

    objectToArray(obj) {
      return Object.keys(obj).map((key, index) => ({
        key,
        label: obj[key],
        sortOrder: index + 1,
      }));
    },
    arrayToObject(arr) {
      return arr.reduce((obj, item) => {
        obj[item.key] = item.label;
        return obj;
      }, {});
    },
    addOption() {
      const newOption = {
        key: "",
        label: "",
        sortOrder: this.options.length + 1,
      };
      this.options.push(newOption);

      this.$nextTick(() => {
        this.makeFieldsSortable();
      });

    },
    removeOption(index) {
      this.options.splice(index, 1);
    },
    captilize(handle) {
      if(handle) {
        return handle.charAt(0).toUpperCase() + handle.slice(1);
      }
    },
    setContainer(container) {
      this.toggleContainer = false;
      this.dirtyField.config.container = container;
      this.dirtyField = { ...this.dirtyField }; 
    },
    clearContainer() {
      this.dirtyField.config.container = null;
      this.dirtyField = { ...this.dirtyField }; 
    },
    assetData() {
      const postData = {
          type: this.dirtyField.fieldtype,
          values: this.dirtyField.config,
      };
      this.$axios.post('/cp/fields/edit', postData)
      .then(response => {
        this.fieldValue = response.data.fieldtype.config[3];
        this.getContainers();
      })
      .catch(error => {
          if (error.response) {
              this.$toast.error(error.response.data.message);
              this.errors = error.response.data.errors;
          } else {
              console.error('Error', error.message);
          }
      });
    },
    getContainers() {
      const configParam = utf8btoa(JSON.stringify(this.fieldValue));
      const url = `/cp/fieldtypes/relationship?config=${configParam}&site=default&paginate=false&columns=title,id`;
      this.$axios.get(url)
      .then(response => {
        this.containers = response.data.data;
      })
      .catch(error => {
        if (error.response) {
          this.$toast.error(error.response.data.message);
          this.errors = error.response.data.errors;
        } else {
          console.error('Error', error.message);
        }
      });
    },

    makeFieldsSortable() {
      if (this.sortableFields) this.sortableFields.destroy();

      const sortableContainer = this.$refs.sortableContainer;

      if (sortableContainer) {

      this.sortableFields = new Sortable(sortableContainer, {
          draggable: '.sortable-row',
          handle: '.table-drag-handle',
          mirror: { constrainDimensions: true, appendTo: 'tbody' },
      })
      //.on('sortable:start', () => console.log('sortable:start'))
      //.on('sortable:sort', () => console.log('sortable:sort'))
      //.on('sortable:sorted', () => console.log('sortable:sorted'))
      .on('sortable:stop', event => this.fieldHasBeenDropped(event));

    } else {
      console.warn('Sortable container not found or not ready.');
    }

      //.on('sortable:stop', e => this.fieldHasBeenDropped(e));
    },

    fieldHasBeenDropped(event) {
      const movedItem = this.options.splice(event.oldIndex, 1)[0];
      this.options.splice(event.newIndex, 0, movedItem);
      this.$nextTick(() => this.makeFieldsSortable());
    },




  }
}
</script>