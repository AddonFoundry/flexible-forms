<template>
	<stack name="inline-editor" v-if="isEditing" @closed="editorClosed()" half>
		<div class="h-full bg-gray-300 overflow-scroll">
			<header
				class="flex items-center sticky top-0 inset-x-0 bg-white shadow px-8 py-2 z-1 h-13">
				<h1 class="flex-1 flex items-center text-xl">
					{{ currentField.config.display }}
					<small
						class="badge-pill bg-gray-100 ml-4 border text-xs text-gray-700 font-medium leading-none flex items-center">
						<template v-if="currentField.config.type == 'text'">
              <svg class="mr-2 h-3 flex-none v-popper--has-tooltip" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="currentField.handle">
                <path d="M0.351464 0.115555V0H5.99163H11.6485V0.115555L11.8326 2.56148C11.9331 4.16642 11.9888 4.98173 12 5.00741V5.12296H11.3975C10.9958 5.12296 10.795 5.11654 10.795 5.1037C10.795 4.84691 10.7671 4.51309 10.7113 4.10222C10.6444 3.52444 10.5495 3.04938 10.4268 2.67704C10.2594 2.22765 9.97489 1.89383 9.57322 1.67556C9.40586 1.57284 9.18271 1.4958 8.90376 1.44444C8.80335 1.41876 8.51883 1.39951 8.05021 1.38667H7.39749V6.49037V11.6133H8.68619H9.95816V12.3067V13H9.69038L7.71548 12.9615C6.56625 12.9486 5.42259 12.9486 4.28452 12.9615L2.30962 13H2.04184V12.3067V11.6133H3.33054H4.60251V6.49037V1.38667H3.94979C3.48117 1.39951 3.19665 1.41876 3.09623 1.44444C2.57183 1.56 2.17015 1.78469 1.89121 2.11852C1.71269 2.32395 1.56764 2.6321 1.45607 3.04296C1.36681 3.41531 1.29428 3.98667 1.23849 4.75704C1.21618 4.97531 1.20502 5.09086 1.20502 5.1037C1.20502 5.11654 1.00418 5.12296 0.60251 5.12296H0V5.00741L0.1841 2.56148C0.284519 0.956542 0.340307 0.141234 0.351464 0.115555Z" fill="#19292f"/>
              </svg>
						</template>
						<template v-else-if="currentField.config.type == 'textarea'">
              <svg class="mr-2 h-3 flex-none v-popper--has-tooltip" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="currentField.handle">
                <path d="M16 16L2 16C1.44771 16 1 15.5523 1 15L0.999999 2C0.999999 1.44772 1.44771 1 2 1L16 1C16.5523 1 17 1.44771 17 2L17 15C17 15.5523 16.5523 16 16 16Z" stroke="#1C2E36" stroke-width="2"/>
                <path d="M9.4248 13.9698L14.6973 8.69739" stroke="#1C2E36" stroke-width="1.6" stroke-linecap="round"/>
                <path d="M12.6973 13.7577L14.6973 11.7577" stroke="#1C2E36" stroke-width="1.6" stroke-linecap="round"/>
              </svg>
						</template>
						<template v-else-if="currentField.config.type == 'select'">
              <svg class="mr-2 h-3 flex-none v-popper--has-tooltip" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="currentField.handle">
                <path d="M0 1H16C17.1046 1 18 1.89543 18 3V16C18 17.1046 17.1046 18 16 18H0" stroke="#19292f" stroke-width="2"/>
                <path d="M9.07106 12.0208L12.0208 9.07106C12.6508 8.44109 12.2046 7.36395 11.3137 7.36395H5.41421C4.52331 7.36395 4.07714 8.44109 4.70711 9.07106L7.65684 12.0208C8.04737 12.4113 8.68053 12.4113 9.07106 12.0208Z" fill="#19292f"/>
              </svg>
						</template>
						<template v-else-if="currentField.config.type == 'checkboxes'">
              <svg class="mr-2 w-3 flex-none v-popper--has-tooltip" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="currentField.handle">
                <rect x="1" y="1" width="16" height="15" rx="1" fill="#19292f" stroke="#19292f" stroke-width="2"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.928 5.36935L7.59309 12.1129L4 8.59968L5.39824 7.16967L7.53242 9.25642L12.4703 4L13.928 5.36935Z" fill="#F1F1F1"/>
              </svg>
						</template>
						<template v-else-if="currentField.config.type == 'radio'">
              <svg class="mr-2 w-3 flex-none v-popper--has-tooltip" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="currentField.handle">
                <rect x="1" y="1" width="15" height="15" rx="7.5" stroke="#19292f" stroke-width="2"/>
                <rect x="4" y="4" width="9" height="9" rx="4.5" fill="#19292f"/>
              </svg>
						</template>
						<template v-else-if="currentField.config.type == 'toggle'">
              <svg class="mr-2 w-3 flex-none v-popper--has-tooltip" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="currentField.handle">
                <rect width="16" height="8.8" rx="4.4" fill="#19292f"/>
                <rect x="8" y="0.799988" width="7.2" height="7.2" rx="3.6" fill="white"/>
              </svg>
						</template>
						<template v-else-if="currentField.config.type == 'integer'">
              <svg class="mr-2 w-3 flex-none v-popper--has-tooltip" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="currentField.handle">
                <path d="M12.8799 0.960022V11.197C12.8799 11.4091 12.8865 11.5846 12.8996 11.7238C12.9194 11.8563 12.972 11.9623 13.0576 12.0418C13.1432 12.1213 13.2715 12.1777 13.4426 12.2108C13.6138 12.2373 13.8573 12.2505 14.1733 12.2505H14.8545V13.96C14.6044 13.96 14.3608 13.96 14.1239 13.96C13.8869 13.96 13.6401 13.96 13.3834 13.96C13.1333 13.9534 12.8667 13.9501 12.5837 13.9501C12.3072 13.9435 12.0045 13.9401 11.6754 13.9401C11.287 13.9401 10.9349 13.9435 10.6189 13.9501C10.3096 13.9501 10.0167 13.9501 9.74025 13.9501C9.4638 13.9501 9.19394 13.9534 8.93066 13.96C8.66737 13.96 8.39422 13.96 8.11119 13.96V12.2505H9.03926C9.31571 12.2505 9.52633 12.2307 9.67114 12.1909C9.82252 12.1445 9.93442 12.0783 10.0068 11.9921C10.0792 11.906 10.122 11.7967 10.1352 11.6642C10.1483 11.525 10.1549 11.3627 10.1549 11.1771V3.68326C9.96404 3.78928 9.76328 3.88867 9.55266 3.98143C9.34862 4.07419 9.14457 4.16033 8.94053 4.23984C8.74307 4.31272 8.5489 4.37898 8.35802 4.43862C8.17372 4.49162 8.00588 4.53138 7.85449 4.55788V2.56017C8.5127 2.45416 9.10508 2.2587 9.63164 1.97378C10.1648 1.68887 10.6189 1.35095 10.9941 0.960022H12.8799Z" fill="#19292f"/>
                <rect x="0.187988" y="12.2696" width="6.6665" height="1.69043" fill="#19292f"/>
              </svg>
						</template>
            <template v-else-if="currentField.config.type == 'assets'">
							<svg class="mr-2 w-3 flex-none v-popper--has-tooltip" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="currentField.handle">
                <rect width="17" height="2.61538" fill="#1C2E36"/>
                <path d="M6.10249 17H10.8974V10.4616H15.6922L8.49992 3.9231L1.30762 10.4616H6.10249V17Z" fill="#1C2E36"/>
              </svg>
						</template>
            <template v-else-if="currentField.config.type == 'spacer'">
							<svg class="mr-2 w-3 flex-none v-popper--has-tooltip" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect y="15" width="15" height="2" transform="rotate(-90 0 15)" fill="#1C2E36"/>
                <rect x="14" y="15" width="15" height="2" transform="rotate(-90 14 15)" fill="#1C2E36"/>
                <path d="M5.85714 11L3 7L5.85714 3V5H10.1429V3L13 7L10.1429 11V9H8.71429H5.85714V11Z" fill="#1C2E36"/>
              </svg>
						</template>
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
                  <p>The field's label shown in the Control Panel.</p>
                </div>
              </div>
              <div class="flex items-center">
                <div class="input-group">
                  <input id="field_display" name="display" type="text" class="input-text" v-model="dirtyField.config.display">
                  <button v-if="dirtyField.config.hide_display" @click="dirtyField.config.hide_display = false" v-tooltip="'Hidden'" class="input-group-append flex items-center v-popper--has-tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-100"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M.91 12.59a1 1 0 0 1 0-1.18C2.11 9.8 5.9 5.5 12 5.5s9.89 4.3 11.09 5.91a1 1 0 0 1 0 1.18c-1.2 1.61-5 5.91-11.09 5.91S2.11 14.2.91 12.59Z"></path><path d="M7.76 13.5A4.38 4.38 0 0 1 7.5 12 4.49 4.49 0 0 1 12 7.5a4.38 4.38 0 0 1 1.5.26M15.18 8.82a4.5 4.5 0 1 1-6.36 6.36M17 7 6.75 17.25"></path></g></svg>
                  </button>
                  <button v-else @click="dirtyField.config.hide_display = true" v-tooltip="'Visible'" class="input-group-append flex items-center v-popper--has-tooltip">
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
                <button @click="setInputType('text')" class="btn btn-sm flex w-full justify-center items-center" :class="{ 'active': dirtyField.config.input_type === 'text' }">text</button>
                <button @click="setInputType('email')" class="btn btn-sm flex w-full justify-center items-center" :class="{ 'active': dirtyField.config.input_type === 'email' }">email</button>
                <button @click="setInputType('tel')" class="btn btn-sm flex w-full justify-center items-center" :class="{ 'active': dirtyField.config.input_type === 'tel' }">tel</button>
                <button @click="setInputType('date')" class="btn btn-sm flex w-full justify-center items-center" :class="{ 'active': dirtyField.config.input_type === 'date' }">date</button>
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
                  <p>Set placeholder text.</p>
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
      sortableFields: null,
      fieldValue: {},
      containers: {},
      toggleContainer: false,
      highlightedIndex: null,
    }
  },
  props: ['blueprint', 'currentField', 'isEditing'],
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
      this.$emit('fieldModified', { ...this.dirtyField });
      this.$events.$emit('event.close-stack');
    },
    editorClosed() {
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
    setupOptions() {
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