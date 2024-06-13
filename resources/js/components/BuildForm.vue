<template>

  <div>

  <publish-container>
  
    <div class="blueprint-builder @container">

        <header class="mb-6">
            <div class="flex items-center justify-between">
                <h1 v-text="__('Form Builder')" />
                <button type="submit" class="btn-primary" @click.prevent="save" v-text="__('Save')" />
            </div>
        </header>
  
        <section class="card inline-flex mt-5 mb-2 p-0 rounded-md px-1">
          <span class="inline-flex items-center py-3 px-4 text-sm font-semibold rounded-md opacity-50">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.33333 2H3C2.44772 2 2 2.44772 2 3V13C2 13.5523 2.44772 14 3 14H13C13.5523 14 14 13.5523 14 13V8.35294" stroke="black" stroke-linecap="round"></path><path d="M8.067 10.1593L13.8605 4.36403C13.946 4.27851 14 4.15248 14 4.02195C14 3.90742 13.9585 3.7889 13.86 3.69088L12.3025 2.13853C12.21 2.04601 12.088 2 11.9665 2C11.845 2 11.7235 2.04601 11.6305 2.13853L5.8275 7.92282C5.543 8.80451 5.05 10.3349 5.0145 10.4639C5.0045 10.5014 5 10.5389 5 10.5759C5 10.8065 5.1745 11 5.3825 11C5.638 11 5.878 10.9055 8.067 10.1593ZM6.432 8.48794L7.5005 9.55668L5.9165 10.0798L6.432 8.48794ZM6.9095 7.90481L11.9665 2.86419L13.134 4.02795L8.0845 9.07957L6.9095 7.90481Z" fill="black"></path></svg>
            <span class="ml-2">Form Builder</span>
          </span>
          <a :href="pageUrl + '/submissions'" class="inline-flex items-center py-3 px-4 text-sm font-semibold rounded-md">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 13L10 13" stroke="black" stroke-linecap="round"></path><path d="M2 9.66663L14 9.66663" stroke="black" stroke-linecap="round"></path><path d="M2 6.33337L14 6.33338" stroke="black" stroke-linecap="round"></path><path d="M2 3L14 3" stroke="black" stroke-linecap="round"></path></svg>
            <span class="ml-2">Submissions</span>
          </a>
          <a :href="pageUrl + '/edit'" class="inline-flex items-center py-3 px-4 text-sm font-semibold rounded-md">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 6.05517C6.92783 6.05517 6.05575 6.92783 6.05575 8C6.05575 9.07217 6.92783 9.94425 8 9.94425C9.07217 9.94425 9.94425 9.07217 9.94425 8C9.94425 6.92783 9.07217 6.05517 8 6.05517ZM8 10.5276C6.60583 10.5276 5.47242 9.39417 5.47242 8C5.47242 6.60583 6.60583 5.47183 8 5.47183C9.39417 5.47183 10.5276 6.60583 10.5276 8C10.5276 9.39417 9.39417 10.5276 8 10.5276ZM7.30408 14.4167H8.69592C8.917 13.7727 9.08558 12.9869 9.925 12.6375C10.7977 12.2776 11.4802 12.7518 12.0454 13.0295L13.0289 12.0448C12.7326 11.4341 12.2904 10.7621 12.6387 9.92092C12.9694 9.12233 13.6531 8.95083 14.4167 8.6965V7.3035C13.6962 7.05792 12.9752 6.8905 12.6392 6.07967C12.3056 5.27467 12.6725 4.68258 13.0295 3.95458L12.0454 2.97108C11.3938 3.29017 10.7498 3.70433 9.92092 3.36075C9.11942 3.02767 8.95492 2.34925 8.69592 1.58333H7.30408C7.05675 2.30142 6.89342 3.023 6.07967 3.36017C5.86675 3.44942 5.66083 3.492 5.45142 3.492C4.95967 3.492 4.55367 3.26333 3.95458 2.97108L2.9705 3.95458C3.30533 4.64 3.70025 5.2595 3.36075 6.07967C3.02767 6.88175 2.34925 7.0445 1.58333 7.3035V8.6965C2.2985 8.94033 3.023 9.10775 3.36075 9.92033C3.69967 10.7387 3.317 11.339 2.9705 12.0454L3.95458 13.0295C4.80042 12.6066 5.32833 12.3272 6.07908 12.6392C6.88292 12.9729 7.0445 13.6531 7.30408 14.4167ZM9.10892 15H6.8905C6.49325 13.8812 6.43258 13.4174 5.85625 13.1783C5.27 12.9338 4.8465 13.2552 3.83442 13.7336L2.26583 12.165C2.77508 11.0934 3.06325 10.7271 2.82175 10.1437C2.58142 9.56567 2.12642 9.50967 1 9.1095V6.8905C2.11183 6.495 2.582 6.43433 2.82175 5.85625C3.0615 5.27817 2.78033 4.91533 2.26583 3.83442L3.83442 2.26642C4.85 2.74942 5.27292 3.06267 5.85567 2.82233C6.43433 2.582 6.48683 2.13108 6.89108 1H9.10892C9.50675 2.11883 9.56858 2.58317 10.1437 2.82175C10.7277 3.06442 11.1407 2.75233 12.1662 2.26642L13.7336 3.83442C13.2214 4.91183 12.9397 5.27933 13.1783 5.85567C13.418 6.43433 13.8736 6.48975 15 6.8905V9.11008C13.8882 9.505 13.4174 9.56625 13.1777 10.1443C12.9426 10.7131 13.2033 11.0549 13.7342 12.165L12.1662 13.7336C11.1582 13.2552 10.7271 12.9344 10.1502 13.1765C9.57383 13.4157 9.52017 13.845 9.10892 15Z" fill="black"></path></svg>
            <span class="ml-2">Form Settings</span>
          </a>
        </section>
  
        <section class="flex justify-between">
          <div class="card w-63 bg-white pt-8 pb-6 px-8 rounded-md">
            <p class="text-lg font-semibold">{{ slugToTitleCase(blueprint.handle) }}</p>
            <p class="text-12 text-gray-600 mt-0.5 mb-5">Drag fields to reorder them or click on a field to edit it.</p>
  
            <!-- errors -->
            <div v-if="errors" v-for="(error, index) in errors.tabs" class="form-errors">
              <p>{{ error }}</p>
            </div>
  
            
            <div class="blueprint-section-draggable-zone -mx-1 flex flex-wrap flex-1">
            
  
              <div v-if="fields" v-for="(field, index) in fields" class="blueprint-section-field orderable mb-3" :class="widthClass(field)" :key="field._id">
                <div class="blueprint-section-field-inner custom-background-grey">
                  <div class="flex flex-1 items-center justify-between">
                    <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                      <template v-if="field.config.type == 'text'">
                        <!--
                        <svg class="mr-1 h-4 flex-none v-popper--has-tooltip" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="field.handle">
                          <path d="M0.351464 0.115555V0H5.99163H11.6485V0.115555L11.8326 2.56148C11.9331 4.16642 11.9888 4.98173 12 5.00741V5.12296H11.3975C10.9958 5.12296 10.795 5.11654 10.795 5.1037C10.795 4.84691 10.7671 4.51309 10.7113 4.10222C10.6444 3.52444 10.5495 3.04938 10.4268 2.67704C10.2594 2.22765 9.97489 1.89383 9.57322 1.67556C9.40586 1.57284 9.18271 1.4958 8.90376 1.44444C8.80335 1.41876 8.51883 1.39951 8.05021 1.38667H7.39749V6.49037V11.6133H8.68619H9.95816V12.3067V13H9.69038L7.71548 12.9615C6.56625 12.9486 5.42259 12.9486 4.28452 12.9615L2.30962 13H2.04184V12.3067V11.6133H3.33054H4.60251V6.49037V1.38667H3.94979C3.48117 1.39951 3.19665 1.41876 3.09623 1.44444C2.57183 1.56 2.17015 1.78469 1.89121 2.11852C1.71269 2.32395 1.56764 2.6321 1.45607 3.04296C1.36681 3.41531 1.29428 3.98667 1.23849 4.75704C1.21618 4.97531 1.20502 5.09086 1.20502 5.1037C1.20502 5.11654 1.00418 5.12296 0.60251 5.12296H0V5.00741L0.1841 2.56148C0.284519 0.956542 0.340307 0.141234 0.351464 0.115555Z" fill="#19292f"/>
                        </svg>
                        -->
                        <svg class="mr-1 h-4 flex-none v-popper--has-tooltip" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="field.handle">
                          <path d="M0.351464 0.115555V0H5.99163H11.6485V0.115555L11.8326 2.56148C11.9331 4.16642 11.9888 4.98173 12 5.00741V5.12296H11.3975C10.9958 5.12296 10.795 5.11654 10.795 5.1037C10.795 4.84691 10.7671 4.51309 10.7113 4.10222C10.6444 3.52444 10.5495 3.04938 10.4268 2.67704C10.2594 2.22765 9.97489 1.89383 9.57322 1.67556C9.40586 1.57284 9.18271 1.4958 8.90376 1.44444C8.80335 1.41876 8.51883 1.39951 8.05021 1.38667H7.39749V6.49037V11.6133H8.68619H9.95816V12.3067V13H9.69038L7.71548 12.9615C6.56625 12.9486 5.42259 12.9486 4.28452 12.9615L2.30962 13H2.04184V12.3067V11.6133H3.33054H4.60251V6.49037V1.38667H3.94979C3.48117 1.39951 3.19665 1.41876 3.09623 1.44444C2.57183 1.56 2.17015 1.78469 1.89121 2.11852C1.71269 2.32395 1.56764 2.6321 1.45607 3.04296C1.36681 3.41531 1.29428 3.98667 1.23849 4.75704C1.21618 4.97531 1.20502 5.09086 1.20502 5.1037C1.20502 5.11654 1.00418 5.12296 0.60251 5.12296H0V5.00741L0.1841 2.56148C0.284519 0.956542 0.340307 0.141234 0.351464 0.115555Z" fill="#19292f"/>
                        </svg>

                      </template>
                      <template v-else-if="field.config.type == 'textarea'">
                        <svg class="mr-1 h-4 flex-none v-popper--has-tooltip" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="field.handle">
                          <rect x="1" y="1" width="16" height="15" rx="1" stroke="#19292f" stroke-width="2"/>
                          <rect x="4" y="4" width="10" height="2" fill="#19292f"/>
                          <rect x="4" y="7" width="10" height="2" fill="#19292f"/>
                          <rect x="4" y="10" width="7" height="2" fill="#19292f"/>
                        </svg>
                      </template>

                      

                      <template v-else-if="field.config.type == 'select'">
                        <svg class="mr-1 h-4 flex-none v-popper--has-tooltip" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="field.handle">
                          <path d="M0 1H16C17.1046 1 18 1.89543 18 3V16C18 17.1046 17.1046 18 16 18H0" stroke="#19292f" stroke-width="2"/>
                          <path d="M9.07106 12.0208L12.0208 9.07106C12.6508 8.44109 12.2046 7.36395 11.3137 7.36395H5.41421C4.52331 7.36395 4.07714 8.44109 4.70711 9.07106L7.65684 12.0208C8.04737 12.4113 8.68053 12.4113 9.07106 12.0208Z" fill="#19292f"/>
                        </svg>
                      </template>
                      <template v-else-if="field.config.type == 'checkboxes'">
                        <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="field.handle">
                          <rect x="1" y="1" width="16" height="15" rx="1" fill="#19292f" stroke="#19292f" stroke-width="2"/>
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M13.928 5.36935L7.59309 12.1129L4 8.59968L5.39824 7.16967L7.53242 9.25642L12.4703 4L13.928 5.36935Z" fill="#F1F1F1"/>
                        </svg>
                      </template>
                      <template v-else-if="field.config.type == 'radio'">
                        <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" v-tooltip="field.handle">
                          <rect x="1" y="1" width="15" height="15" rx="7.5" stroke="#19292f" stroke-width="2"/>
                          <rect x="4" y="4" width="9" height="9" rx="4.5" fill="#19292f"/>
                        </svg>
                      </template>
                      <template v-else-if="field.config.type == 'toggle'">
                        <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <rect width="16" height="8.8" rx="4.4" fill="#19292f"/>
                          <rect x="8" y="0.799988" width="7.2" height="7.2" rx="3.6" fill="white"/>
                        </svg>
                      </template>
                      <template v-else-if="field.config.type == 'integer'">
                        <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M12.8799 0.960022V11.197C12.8799 11.4091 12.8865 11.5846 12.8996 11.7238C12.9194 11.8563 12.972 11.9623 13.0576 12.0418C13.1432 12.1213 13.2715 12.1777 13.4426 12.2108C13.6138 12.2373 13.8573 12.2505 14.1733 12.2505H14.8545V13.96C14.6044 13.96 14.3608 13.96 14.1239 13.96C13.8869 13.96 13.6401 13.96 13.3834 13.96C13.1333 13.9534 12.8667 13.9501 12.5837 13.9501C12.3072 13.9435 12.0045 13.9401 11.6754 13.9401C11.287 13.9401 10.9349 13.9435 10.6189 13.9501C10.3096 13.9501 10.0167 13.9501 9.74025 13.9501C9.4638 13.9501 9.19394 13.9534 8.93066 13.96C8.66737 13.96 8.39422 13.96 8.11119 13.96V12.2505H9.03926C9.31571 12.2505 9.52633 12.2307 9.67114 12.1909C9.82252 12.1445 9.93442 12.0783 10.0068 11.9921C10.0792 11.906 10.122 11.7967 10.1352 11.6642C10.1483 11.525 10.1549 11.3627 10.1549 11.1771V3.68326C9.96404 3.78928 9.76328 3.88867 9.55266 3.98143C9.34862 4.07419 9.14457 4.16033 8.94053 4.23984C8.74307 4.31272 8.5489 4.37898 8.35802 4.43862C8.17372 4.49162 8.00588 4.53138 7.85449 4.55788V2.56017C8.5127 2.45416 9.10508 2.2587 9.63164 1.97378C10.1648 1.68887 10.6189 1.35095 10.9941 0.960022H12.8799Z" fill="#19292f"/>
                          <rect x="0.187988" y="12.2696" width="6.6665" height="1.69043" fill="#19292f"/>
                        </svg>
                      </template>
                      <template v-else-if="field.config.type == 'assets'">
                        <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H2L2 15H16V2ZM2 0C0.895431 0 0 0.89543 0 2V15C0 16.1046 0.89543 17 2 17H16C17.1046 17 18 16.1046 18 15V2C18 0.895431 17.1046 0 16 0H2Z" fill="#19292f"/>
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2171 5.71655L17.3976 14.4462L15.6776 15.4669L12.2007 9.60781L7.83258 16.8287L4.79721 12.2231L2.24808 15.5632L0.658203 14.3498L4.91669 8.77002L7.76014 13.0844L12.2171 5.71655Z" fill="#19292f"/>
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M6.25781 6.66217C7.05442 6.66217 7.7002 6.01639 7.7002 5.21979C7.7002 4.42318 7.05442 3.7774 6.25781 3.7774C5.46121 3.7774 4.81543 4.42318 4.81543 5.21979C4.81543 6.01639 5.46121 6.66217 6.25781 6.66217ZM6.25781 7.66217C7.6067 7.66217 8.7002 6.56868 8.7002 5.21979C8.7002 3.8709 7.6067 2.7774 6.25781 2.7774C4.90892 2.7774 3.81543 3.8709 3.81543 5.21979C3.81543 6.56868 4.90892 7.66217 6.25781 7.66217Z" fill="#19292f"/>
                        </svg>
                      </template>
                      

                      <a @click="editField(index, $event)" class="break-all text-12 font-semibold ml-1">{{ field.config.display }}</a>
                    </div>
                  </div>
                  
                  <width-selector v-if="!isHidden" v-model="field.config.width" class="rtl:ml-2 ltr:mr-2" />
  
                  <div class="blueprint-drag-handle w-5"></div>
                  <button class="text-gray-600 hover:text-gray-950 flex items-center v-popper--has-tooltip ml-2" @click="removeField(index)"><svg viewBox="0 0 16 16" class="h-3.5 w-3.5"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M1 3h14M9.5 1h-3a1 1 0 0 0-1 1v1h5V2a1 1 0 0 0-1-1zm-3 10.5v-5m3 5v-5m3.077 7.583a1 1 0 0 1-.997.917H4.42a1 1 0 0 1-.996-.917L2.5 3h11l-.923 11.083z"></path></svg></button>
  
  
              
  
                </div>
              </div>
  
    
  
          </div>
  
  
            <div data-tab="main" data-section="main-0" class="-mx-1 mt-2 mb-10" tabindex="0" @dragover="dragOver" @drop="drop">
              <div class="text-2xs text-gray-600 text-center border border-dashed rounded mb-2 p-6">Drag form fields here</div>
            </div>
  
          </div>
          <div class="card w-35 bg-white p-6 rounded-md">
            
            <p class="text-lg font-semibold">Available Fields</p>
            <p class="text-12 text-gray-600 mt-0.5 mb-5">Drag form fields into the form to start building.</p>
  
            <div class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" data-field="text">
              <div class="blueprint-section-field-inner custom-background-grey">
                <div class="flex flex-1 items-center justify-between">
                  <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                      <svg class="mr-1 h-4 flex-none v-popper--has-tooltip" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.351464 0.115555V0H5.99163H11.6485V0.115555L11.8326 2.56148C11.9331 4.16642 11.9888 4.98173 12 5.00741V5.12296H11.3975C10.9958 5.12296 10.795 5.11654 10.795 5.1037C10.795 4.84691 10.7671 4.51309 10.7113 4.10222C10.6444 3.52444 10.5495 3.04938 10.4268 2.67704C10.2594 2.22765 9.97489 1.89383 9.57322 1.67556C9.40586 1.57284 9.18271 1.4958 8.90376 1.44444C8.80335 1.41876 8.51883 1.39951 8.05021 1.38667H7.39749V6.49037V11.6133H8.68619H9.95816V12.3067V13H9.69038L7.71548 12.9615C6.56625 12.9486 5.42259 12.9486 4.28452 12.9615L2.30962 13H2.04184V12.3067V11.6133H3.33054H4.60251V6.49037V1.38667H3.94979C3.48117 1.39951 3.19665 1.41876 3.09623 1.44444C2.57183 1.56 2.17015 1.78469 1.89121 2.11852C1.71269 2.32395 1.56764 2.6321 1.45607 3.04296C1.36681 3.41531 1.29428 3.98667 1.23849 4.75704C1.21618 4.97531 1.20502 5.09086 1.20502 5.1037C1.20502 5.11654 1.00418 5.12296 0.60251 5.12296H0V5.00741L0.1841 2.56148C0.284519 0.956542 0.340307 0.141234 0.351464 0.115555Z" fill="#19292f"/>
                      </svg>
                    <p class="break-all text-12 font-semibold ml-2 hover:text-black">Text Field</p>
                  </div>
                </div>
                <div class="blueprint-drag-handle w-6"></div>
              </div>
            </div>
  
            <div class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" data-field="textarea">
              <div class="blueprint-section-field-inner custom-background-grey">
                <div class="flex flex-1 items-center justify-between">
                  <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                    <svg class="mr-1 h-4 flex-none v-popper--has-tooltip" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="1" y="1" width="16" height="15" rx="1" stroke="#19292f" stroke-width="2"/>
                      <rect x="4" y="4" width="10" height="2" fill="#19292f"/>
                      <rect x="4" y="7" width="10" height="2" fill="#19292f"/>
                      <rect x="4" y="10" width="7" height="2" fill="#19292f"/>
                    </svg>
                    <p class="break-all text-12 font-semibold ml-2 hover:text-black">Textarea</p>
                  </div>
                </div>
                <div class="blueprint-drag-handle w-6"></div>
              </div>
            </div>
  
            <div class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" data-field="select">
              <div class="blueprint-section-field-inner custom-background-grey">
                <div class="flex flex-1 items-center justify-between">
                  <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                    <svg class="mr-1 h-4 flex-none v-popper--has-tooltip" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 1H16C17.1046 1 18 1.89543 18 3V16C18 17.1046 17.1046 18 16 18H0" stroke="#19292f" stroke-width="2"/>
                      <path d="M9.07106 12.0208L12.0208 9.07106C12.6508 8.44109 12.2046 7.36395 11.3137 7.36395H5.41421C4.52331 7.36395 4.07714 8.44109 4.70711 9.07106L7.65684 12.0208C8.04737 12.4113 8.68053 12.4113 9.07106 12.0208Z" fill="#19292f"/>
                    </svg>
                    <p class="break-all text-12 font-semibold ml-2 hover:text-black">Select</p>
                  </div>
                </div>
                <div class="blueprint-drag-handle w-6"></div>
              </div>
            </div>
  
            <div class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" data-field="checkboxes">
              <div class="blueprint-section-field-inner custom-background-grey">
                <div class="flex flex-1 items-center justify-between">
                  <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                      <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="16" height="15" rx="1" fill="#19292f" stroke="#19292f" stroke-width="2"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.928 5.36935L7.59309 12.1129L4 8.59968L5.39824 7.16967L7.53242 9.25642L12.4703 4L13.928 5.36935Z" fill="#F1F1F1"/>
                      </svg>
                    <p class="break-all text-12 font-semibold ml-2 hover:text-black">Checkboxes</p>
                  </div>
                </div>
                <div class="blueprint-drag-handle w-6"></div>
              </div>
            </div>
  
            <div class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" data-field="radio">
              <div class="blueprint-section-field-inner custom-background-grey">
                <div class="flex flex-1 items-center justify-between">
                  <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                    <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="1" y="1" width="15" height="15" rx="7.5" stroke="#19292f" stroke-width="2"/>
                      <rect x="4" y="4" width="9" height="9" rx="4.5" fill="#19292f"/>
                    </svg>
                    <p class="break-all text-12 font-semibold ml-2 hover:text-black">Radio</p>
                  </div>
                </div>
                <div class="blueprint-drag-handle w-6"></div>
              </div>
            </div>
  
            <div class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" data-field="toggle">
              <div class="blueprint-section-field-inner custom-background-grey">
                <div class="flex flex-1 items-center justify-between">
                  <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                    <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="16" height="8.8" rx="4.4" fill="#19292f"/>
                      <rect x="8" y="0.799988" width="7.2" height="7.2" rx="3.6" fill="white"/>
                    </svg>
                    <p class="break-all text-12 font-semibold ml-2 hover:text-black">Toggle</p>
                  </div>
                </div>
                <div class="blueprint-drag-handle w-6"></div>
              </div>
            </div>
  
            <div class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" data-field="integer">
              <div class="blueprint-section-field-inner custom-background-grey">
                <div class="flex flex-1 items-center justify-between">
                  <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                    <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12.8799 0.960022V11.197C12.8799 11.4091 12.8865 11.5846 12.8996 11.7238C12.9194 11.8563 12.972 11.9623 13.0576 12.0418C13.1432 12.1213 13.2715 12.1777 13.4426 12.2108C13.6138 12.2373 13.8573 12.2505 14.1733 12.2505H14.8545V13.96C14.6044 13.96 14.3608 13.96 14.1239 13.96C13.8869 13.96 13.6401 13.96 13.3834 13.96C13.1333 13.9534 12.8667 13.9501 12.5837 13.9501C12.3072 13.9435 12.0045 13.9401 11.6754 13.9401C11.287 13.9401 10.9349 13.9435 10.6189 13.9501C10.3096 13.9501 10.0167 13.9501 9.74025 13.9501C9.4638 13.9501 9.19394 13.9534 8.93066 13.96C8.66737 13.96 8.39422 13.96 8.11119 13.96V12.2505H9.03926C9.31571 12.2505 9.52633 12.2307 9.67114 12.1909C9.82252 12.1445 9.93442 12.0783 10.0068 11.9921C10.0792 11.906 10.122 11.7967 10.1352 11.6642C10.1483 11.525 10.1549 11.3627 10.1549 11.1771V3.68326C9.96404 3.78928 9.76328 3.88867 9.55266 3.98143C9.34862 4.07419 9.14457 4.16033 8.94053 4.23984C8.74307 4.31272 8.5489 4.37898 8.35802 4.43862C8.17372 4.49162 8.00588 4.53138 7.85449 4.55788V2.56017C8.5127 2.45416 9.10508 2.2587 9.63164 1.97378C10.1648 1.68887 10.6189 1.35095 10.9941 0.960022H12.8799Z" fill="#19292f"/>
                      <rect x="0.187988" y="12.2696" width="6.6665" height="1.69043" fill="#19292f"/>
                    </svg>
                    <p class="break-all text-12 font-semibold ml-2 hover:text-black">Integer</p>
                  </div>
                </div>
                <div class="blueprint-drag-handle w-6"></div>
              </div>
            </div>
  
            <div class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" data-field="assets">
              <div class="blueprint-section-field-inner custom-background-grey">
                <div class="flex flex-1 items-center justify-between">
                  <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                    <svg class="mr-1 w-4 flex-none v-popper--has-tooltip" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H2L2 15H16V2ZM2 0C0.895431 0 0 0.89543 0 2V15C0 16.1046 0.89543 17 2 17H16C17.1046 17 18 16.1046 18 15V2C18 0.895431 17.1046 0 16 0H2Z" fill="#19292f"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2171 5.71655L17.3976 14.4462L15.6776 15.4669L12.2007 9.60781L7.83258 16.8287L4.79721 12.2231L2.24808 15.5632L0.658203 14.3498L4.91669 8.77002L7.76014 13.0844L12.2171 5.71655Z" fill="#19292f"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M6.25781 6.66217C7.05442 6.66217 7.7002 6.01639 7.7002 5.21979C7.7002 4.42318 7.05442 3.7774 6.25781 3.7774C5.46121 3.7774 4.81543 4.42318 4.81543 5.21979C4.81543 6.01639 5.46121 6.66217 6.25781 6.66217ZM6.25781 7.66217C7.6067 7.66217 8.7002 6.56868 8.7002 5.21979C8.7002 3.8709 7.6067 2.7774 6.25781 2.7774C4.90892 2.7774 3.81543 3.8709 3.81543 5.21979C3.81543 6.56868 4.90892 7.66217 6.25781 7.66217Z" fill="#19292f"/>
                    </svg>
                    <p class="break-all text-12 font-semibold ml-2 hover:text-black">Assets</p>
                  </div>
                </div>
                <div class="blueprint-drag-handle w-6"></div>
              </div>
            </div>
  
          </div>
        </section>
  
      </div>
  
    </publish-container>

    <field-stack :blueprint="blueprint" :currentField="currentField" :isEditing="isEditing"></field-stack>


    </div>
  
  </template>
  
  <script>
  
  import {Sortable, Plugins} from '@shopify/draggable';
  import WidthSelector from './WidthSelector.vue';
  import FieldStack from './FieldStack.vue';

  export default {

    props: {
        action: String,
        initialBlueprint: Object,
        showTitle: Boolean,
        isFormBlueprint: { type: Boolean, default: false },
        showHidden: { type: Boolean, default: true },
    },

    components: {
          FieldStack,
          WidthSelector,
      },
  
    data() {
        return {
            blueprint: this.initializeBlueprint(),
            errors: {},
            fields: [],
            sortableFields: null,
            isSelectingNewFieldtype: false,
            pendingCreatedField: null,
            pageUrl: null,
            isEditing: false,
            currentField: null,     
      }
    },
  
    created() {
        this.$keys.bindGlobal(['mod+s'], e => {
            e.preventDefault();
            this.save();
        });
  
        if (this.isFormBlueprint) {
            Statamic.$config.set('isFormBlueprint', true);
        }
  
        this.fields = this.blueprint.tabs[0].sections[0].fields;
  
        this.$events.$on('event.close-stack', this.editorClosed);

    },
  
    mounted() {
      //this.fields = this.blueprint.tabs[0].sections[0].fields;
      this.makeFieldsSortable();
  
      this.pageUrl = window.location.href.replace(/\/[^/]*$/, '');

    },
  
    computed: {
    
  
      widthClass() {
        return (field) => {
          if (field && field.config && field.config.width) {
            let width = field.config.width;
            return `blueprint-section-field-${tailwind_width_class(width)}`;
          }
          return 'blueprint-section-field-w-full';
        };
      },
  
    },
  
    destroyed() {
      if (this.sortableFields) this.sortableFields.destroy();
    },
  
    watch: {
  
        blueprint: {
            deep: true,
            handler() {
                this.$dirty.add('blueprints');
            }
        },
  
    },
  
    methods: {

      editorClosed() {
        this.isEditing = false;
      },
  
      editField(index) {

        let fieldId = this.blueprint.tabs[0].sections[0].fields[index]._id;

        //this.$events.$emit('field-editing', fieldId)
          
          // TBC
  
          //let fieldId = this.blueprint.tabs[0].sections[0].fields[index]._id;

          //console.log(fieldId);
  
          this.currentField = this.blueprint.tabs[0].sections[0].fields[index]; // make this dirty
  
          this.isEditing = true;
          

          //console.log(fieldId + ' - ' + this.isEditing);
  
          
  
          //this.$emit('field-editing', fieldId);
  
          // @edit="$emit('field-editing', field._id)"
  
        },
  
  
        makeFieldsSortable() {
            if (this.sortableFields) this.sortableFields.destroy();
            
  
            this.sortableFields = new Sortable(this.$el.querySelectorAll('.blueprint-section-draggable-zone'), {
                draggable: '.blueprint-section-field',
                handle: '.blueprint-drag-handle',
                mirror: { constrainDimensions: true, appendTo: 'body' },
            })
            //.on('drag:start', e => this.lastInteractedTab = this.currentTab)
            //.on('drag:stop', e => this.lastInteractedTab = null)
            .on('sortable:stop', e => this.fieldHasBeenDropped(e));
        },
  
         fieldHasBeenDropped(e) {
  
            let newIndex = e.newIndex;  
  
            const field = this.fields.splice(e.oldIndex, 1)[0];
            this.fields.splice(newIndex, 0, field);
  
            //this.$forceUpdate();
          
            this.$nextTick(() => this.makeFieldsSortable());
            
        },
  
  
  
        initializeBlueprint() {
            let blueprint = clone(this.initialBlueprint);
  
            if (! this.showTitle) delete blueprint.title;
  
            return blueprint;
        },
  
        tabsUpdated(tabs) {
            this.blueprint.tabs = tabs;
        },
  
        save() {
            // this.$axios[this.method](this.action, this.fieldset)
            this.$axios['patch'](this.action, this.blueprint)
                .then(response => this.saved(response))
                .catch(e => {
                    this.$toast.error(e.response.data.message);
                    this.errors = e.response.data.errors;
                })
        },
  
        saved(response) {
            this.$toast.success(__('Saved'));
            this.errors = {};
            this.$dirty.remove('blueprints');
        },
  
        removeField(index) {
            this.blueprint.tabs[0].sections[0].fields.splice(index, 1);
            this.$toast.success(__('Field removed'));
            this.errors = {};
        },
        
        slugToTitleCase(slug) {
          let words = slug.replace(/[-_]/g, ' ').split(' ');
          words = words.map(word => word.charAt(0).toUpperCase() + word.slice(1));
          return words.join(' ');
        },
  
        dragStart(event) {
          event.dataTransfer.setData('text/plain', event.target.dataset.field);
        // Add any other necessary drag start logic
        },
  
        dragOver(event) {
          event.preventDefault();
        },
  
        drop(event) {
          event.preventDefault(); // Prevent default behavior to allow drop
          const data = event.dataTransfer.getData('text/plain');
          //const draggedElement = document.getElementById(data);
          //event.target.appendChild(draggedElement);
          // Add any necessary drop logic
          // alert(data); 
  
          const dataUpper = data.charAt(0).toUpperCase() + data.slice(1);
  
          let extraData = '';
          if(dataUpper == 'Text') {
            extraData = ' Field';
          }
  
          const newData = {
            handle: data + "_field",
            type: "inline",
            config: {
              //input_type: "text",
              //antlers: false,
              type: data,
              display: dataUpper + extraData,
              //listable: "hidden",
              //instructions_position: "above",
              //visibility: "visible",
              //replicator_preview: true,
              //hide_display: false,
              width: 100,
              //localizable: false
            },
            fieldtype: data,
            icon: "text",
            _id: "main-0-0"
          };
  
          this.fields.push(newData);
  
          this.$toast.success(__('Field added'));
  
        }
  
    }
  
  }
  </script>