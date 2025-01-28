<template>
  <section>
    <publish-container>
      <div class="blueprint-builder @container flexible-forms">
        <header class="mb-6">
          <div class="flex items-center justify-between">
            <h1 v-text="__('Form Builder')" />
            <button type="submit" class="btn-primary" @click.prevent="save" v-text="__('Save')" />
          </div>
        </header>
        <section class="card nav-card inline-flex mt-5 mb-2 p-0 rounded-md px-1">
          <span class="inline-flex items-center py-3 px-4 text-sm font-semibold rounded-md" style="color:#2995ef;">
            <svg class="active" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.33333 2H3C2.44772 2 2 2.44772 2 3V13C2 13.5523 2.44772 14 3 14H13C13.5523 14 14 13.5523 14 13V8.35294" stroke="#2995ef" stroke-linecap="round"></path><path d="M8.067 10.1593L13.8605 4.36403C13.946 4.27851 14 4.15248 14 4.02195C14 3.90742 13.9585 3.7889 13.86 3.69088L12.3025 2.13853C12.21 2.04601 12.088 2 11.9665 2C11.845 2 11.7235 2.04601 11.6305 2.13853L5.8275 7.92282C5.543 8.80451 5.05 10.3349 5.0145 10.4639C5.0045 10.5014 5 10.5389 5 10.5759C5 10.8065 5.1745 11 5.3825 11C5.638 11 5.878 10.9055 8.067 10.1593ZM6.432 8.48794L7.5005 9.55668L5.9165 10.0798L6.432 8.48794ZM6.9095 7.90481L11.9665 2.86419L13.134 4.02795L8.0845 9.07957L6.9095 7.90481Z" fill="#2995ef"></path></svg>
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
        <section class="flex justify-between flex-wrap">

          <div class="w-63 card bg-white rounded-md p-6 sortable-sections">

            <div class="mb-5">
              <p class="text-lg font-semibold">{{ slugToTitleCase(blueprint.handle) }}</p>
              <p class="text-12 text-gray-600 mt-0.5 mb-0">Drag form fields to reorder them or click on a field name to edit it.</p>
            </div>

            <template v-if="sections">
              <div v-for="(section, sectionIndex) in sections" :key="sectionIndex" class="card bg-white rounded-md mt-3 p-0 sortable-section">
                <div class="flex justify-between items-center mb-2 border-b border-gray-300 dark:border-dark-400 py-3 px-4 section-header-background">
                  <p class="text-sm font-semibold">{{ section.display }}</p>
                  <div class="flex justify-center items-center">
                    <button @click="editSection(sectionIndex)" class="text-gray-600 hover:text-gray-950 flex items-center v-popper--has-tooltip ml-2" v-tooltip="'Edit Section'">
                      <svg xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" viewBox="0 0 24 24" class="h-4 w-4">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M22.19 1.81a3.638 3.638 0 0 0-5.169.035l-14.5 14.5L.75 23.25l6.905-1.771 14.5-14.5a3.638 3.638 0 0 0 .035-5.169ZM16.606 2.26l5.134 5.134M14.512 4.354l5.134 5.134M2.521 16.345l5.139 5.129"></path>
                      </svg>
                    </button>
                    <button class="text-gray-600 hover:text-gray-950 flex items-center v-popper--has-tooltip ml-2" 
                            v-tooltip="'Delete Section'"
                            @click="deleteSection(sectionIndex)">
                      <svg viewBox="0 0 16 16" class="h-4 w-4">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M1 3h14M9.5 1h-3a1 1 0 0 0-1 1v1h5V2a1 1 0 0 0-1-1zm-3 10.5v-5m3 5v-5m3.077 7.583a1 1 0 0 1-.997.917H4.42a1 1 0 0 1-.996-.917L2.5 3h11l-.923 11.083z"></path>
                      </svg>
                    </button>
                    <div class="blueprint-drag-handle w-5 h-6 ml-2 sortable-section-handle"></div>
                  </div>
                </div>
                <div class="blueprint-section-draggable-zone flex flex-wrap flex-1 px-2 py-2">
                  <template v-if="section.fields">
                    <div v-for="(field, fieldIndex) in section.fields" 
                         :key="field._id"
                         class="blueprint-section-field orderable mb-3" 
                         :class="widthClass(field)">
                      <div class="blueprint-section-field-inner custom-background-grey">
                        <div class="flex flex-1 items-center justify-between">
                          <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                            <svg-icon class="text-gray-800 dark:text-dark-150 rtl:ml-2 ltr:mr-2 h-4 w-4 flex-none" :name="field.icon.startsWith('<svg') ? field.icon : `light/${field.icon}`" v-tooltip="field.handle" default="light/generic-field" />
                            <a @click="editField(sectionIndex, fieldIndex, $event)" class="break-all text-12 font-semibold ml-1">{{ field.config.display }}<span v-if="field.config.validate && field.config.validate.includes('required')" class="required">*</span></a>
                          </div>
                        </div>
                        <width-selector v-if="!isHidden" v-model="field.config.width" class="rtl:ml-2 ltr:mr-2" />
                        <div class="blueprint-drag-handle w-5"></div>
                        <button class="text-gray-600 hover:text-gray-950 flex items-center v-popper--has-tooltip ml-2" @click="removeField(sectionIndex, fieldIndex)"><svg viewBox="0 0 16 16" class="h-3.5 w-3.5"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M1 3h14M9.5 1h-3a1 1 0 0 0-1 1v1h5V2a1 1 0 0 0-1-1zm-3 10.5v-5m3 5v-5m3.077 7.583a1 1 0 0 1-.997.917H4.42a1 1 0 0 1-.996-.917L2.5 3h11l-.923 11.083z"></path></svg></button>
                      </div>
                    </div>
                  </template>
                </div>
                <div :data-tab="'main'" :data-section="`main-${sectionIndex}`" 
                     class="mt-0 pb-4 px-4" 
                     tabindex="0" 
                     @dragover="dragOver" 
                     @drop="drop">
                  <div class="text-2xs text-gray-600 text-center border border-dashed rounded p-4">
                    Drag and drop new form fields here
                  </div>
                </div>
              </div>
            </template>

            <div class="text-2xs text-gray-600 text-center border border-dashed rounded mb-2 p-4 mt-4 cursor-pointer hover:bg-gray-50"
                 @click="addSection">
              + Add section
            </div>

          </div>

          <div class="w-35">
            <div class="card bg-white p-6 rounded-md sticky top-sticky">
              <p class="text-lg font-semibold">Available Fields</p>
              <p class="text-12 text-gray-600 mt-0.5 mb-5">Drag form fields into the form to start building.</p>
              <template v-if="availableFields" v-for="field in availableFields">
                <div v-if="!excludeFields || !excludeFields.length > 0 || !excludeFields.includes(field.handle)" class="blueprint-section-field blueprint-section-field-w-full draggable mb-3" draggable="true" @dragstart="dragStart" :data-field="field.handle">
                  <div class="blueprint-section-field-inner custom-background-grey">
                    <div class="flex flex-1 items-center justify-between">
                      <div class="flex items-center flex-1 pr-4 py-1 pl-1">
                        <svg-icon class="text-gray-800 dark:text-dark-150 rtl:ml-2 ltr:mr-2 h-4 w-4 flex-none" :name="field.icon.startsWith('<svg') ? field.icon : `light/${field.icon}`" v-tooltip="tooltipText" default="light/generic-field" />
                        <p class="break-all text-12 font-semibold ml-1">{{ field.title }}</p>
                      </div>
                    </div>
                    <div class="flex items-center mr-1 bg-handle px-0.5" @click="addField(field.handle)" v-tooltip="'Add ' + field.handle + ' field'">
                      <svg class="h-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.75 11.5C5.33579 11.5 5 11.1642 5 10.75L5 0.75C5 0.335787 5.33579 -1.46777e-08 5.75 -3.27835e-08C6.16421 -5.08894e-08 6.5 0.335787 6.5 0.75L6.5 10.75C6.5 11.1642 6.16421 11.5 5.75 11.5Z" fill="#999"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M-6.55671e-08 5.75C-2.93554e-08 5.33579 0.335786 5 0.75 5L10.75 5C11.1642 5 11.5 5.33579 11.5 5.75C11.5 6.16421 11.1642 6.5 10.75 6.5L0.75 6.5C0.335786 6.5 -1.01779e-07 6.16421 -6.55671e-08 5.75Z" fill="#999"/>
                      </svg>
                    </div>
                    <div class="blueprint-drag-handle w-5"></div>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </section>
      </div>
    </publish-container>
    <field-stack :blueprint="blueprint" :currentField="currentField" :isEditing="isEditing" @fieldModified="updateField"></field-stack>
  
    <modal v-if="isEditingSection" @closed="isEditingSection = false" :currentSection="currentSection">
      <div slot-scope="{ close }">
        <header class="text-lg font-semibold px-5 py-3 bg-gray-200 dark:bg-dark-550 rounded-t-lg flex items-center justify-between border-b dark:border-dark-900">
          {{ isAddingNewSection ? 'Add Section' : 'Edit Section' }}
        </header>
        <div class="flex-1 px-5 py-6 text-gray dark:text-dark-150">
          <div class="publish-fields">
            <div class="form-group w-full">
              <label>Display</label>
              <input type="text" class="input-text" v-model="newSection.display">
            </div>
          </div>
        </div>
        <div class="px-5 py-3 bg-gray-200 dark:bg-dark-550 rounded-b-lg border-t dark:border-dark-900 flex items-center justify-end text-sm">
          <button @click="close" class="btn-flat">Cancel</button>
          <button @click="saveSection" class="rtl:mr-4 ltr:ml-4 btn-primary">Confirm</button>
        </div>
      </div>
    </modal>
    
  </section>  
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
      availableFields: Array,
      excludeFields: Array,
    },
    components: {
      FieldStack,
      WidthSelector,
    },
    data() {
      return {
        blueprint: this.initializeBlueprint(),
        sections: null,
        errors: {},
        fields: [],
        sortableFields: null,
        isSelectingNewFieldtype: false,
        pendingCreatedField: null,
        pageUrl: null,
        isEditing: false,
        isEditingSection: false,
        currentField: null,     
        currentSection: null,
        newSection: {
          display: ''
        },
        editingSectionIndex: null,
        isAddingNewSection: false,
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

      this.sections = this.blueprint.tabs[0].sections;

      // this.fields = this.blueprint.tabs[0].sections[0].fields;
      this.$events.$on('event.close-stack', this.editorClosed);

      //console.log(this.fields);

    },
    mounted() {
      this.makeSectionsSortable();
      this.makeFieldsSortable();  
      this.pageUrl = window.location.href.replace(/\/[^/]*$/, '');
    },
    computed: {
      sections: {
        get() {
          return this.blueprint.tabs[0].sections;
        },
        set(newSections) {
          this.$set(this.blueprint.tabs[0], 'sections', newSections);
        }
      },
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
      addSection() {
        this.isAddingNewSection = true;
        this.isEditingSection = true;
        this.newSection.display = '';
      },
      editSection(sectionIndex) {
        this.isAddingNewSection = false;
        this.currentSection = this.sections[sectionIndex];
        this.editingSectionIndex = sectionIndex;
        this.newSection.display = this.currentSection.display;
        this.isEditingSection = true;
      },
      editorClosed() {
        this.isEditing = false;
      },
      updateField(updatedField) {
        // Extract section index from the field's _id (format: "main-{sectionIndex}-{fieldIndex}")
        const sectionIndex = parseInt(updatedField._id.split('-')[1]);
        
        // Find the field in the correct section and update it
        const section = this.blueprint.tabs[0].sections[sectionIndex];
        const fieldIndex = section.fields.findIndex(field => field._id === updatedField._id);
        
        if (fieldIndex !== -1) {
          this.blueprint.tabs[0].sections[sectionIndex].fields[fieldIndex] = updatedField;
        }
      },
      addField(handle) {
        const fieldtype = _.findWhere(this.availableFields, { handle });

        const sectionIndex = this.blueprint.tabs[0].sections.length - 1;
        const newId = this.blueprint.tabs[0].sections[sectionIndex].fields.length;

        const newData = {
          handle: fieldtype.handle + "_field",
          type: "inline",
          config: {
            // input_type: "text",
            type: fieldtype.handle,
            display: __(':title Field', { title: fieldtype.title }),
            width: 100,
          },
          fieldtype: fieldtype.handle,
          icon: fieldtype.icon,
          _id: `main-${sectionIndex}-${newId}`
        };

        this.blueprint.tabs[0].sections[sectionIndex].fields.push(newData);
        this.$toast.success(__('Field added'));
      },
      editField(sectionIndex, fieldIndex) {
        this.currentField = this.blueprint.tabs[0].sections[sectionIndex].fields[fieldIndex];
        this.isEditing = true;
      },
      makeFieldsSortable() {
        if (this.sortableFields) this.sortableFields.destroy();
        this.sortableFields = new Sortable(this.$el.querySelectorAll('.blueprint-section-draggable-zone'), {
            draggable: '.blueprint-section-field',
            handle: '.blueprint-drag-handle',
            mirror: { constrainDimensions: true, appendTo: 'body' },
        })
        .on('sortable:stop', e => this.fieldHasBeenDropped(e));
      },
      fieldHasBeenDropped(e) {
        // Get the section elements from the draggable container
        const sectionElements = Array.from(this.$el.querySelectorAll('.blueprint-section-draggable-zone'));
        
        // Find source and target section indexes
        const oldSectionEl = e.oldContainer;
        const newSectionEl = e.newContainer;
        const oldSectionIndex = sectionElements.indexOf(oldSectionEl);
        const newSectionIndex = sectionElements.indexOf(newSectionEl);

        // Get the field from the source section
        const field = this.blueprint.tabs[0].sections[oldSectionIndex].fields.splice(e.oldIndex, 1)[0];
        
        // Add the field to the target section
        this.blueprint.tabs[0].sections[newSectionIndex].fields.splice(e.newIndex, 0, field);

        // Reinitialize sortable after the update
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
        this.$axios['patch'](this.action, this.blueprint)
        .then(response => this.saved(response))
        .catch(e => {
          this.$toast.error(e.response.data.message);
        })
      },
      saved(response) {
        console.log('Before save update:', this.sections.map(s => s.display));
        this.$toast.success(__('Saved'));
        this.errors = {};
        this.$dirty.remove('blueprints');
        this.sections = this.blueprint.tabs[0].sections;
        console.log('After save update:', this.sections.map(s => s.display));
      },
      removeField(sectionIndex, fieldIndex) {
          this.blueprint.tabs[0].sections[sectionIndex].fields.splice(fieldIndex, 1);
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
      },
      dragOver(event) {
        event.preventDefault();
      },
      drop(event) {
        event.preventDefault();
        const handle = event.dataTransfer.getData('text/plain');
        const fieldtype = _.findWhere(this.availableFields, { handle });
        
        // Extract section index from the drop target's data-section attribute
        const sectionId = event.currentTarget.dataset.section;
        const sectionIndex = sectionId.split('-')[1];
        
        // Get the correct length from the target section's fields array
        const newId = this.blueprint.tabs[0].sections[sectionIndex].fields.length;

        const newData = {
            handle: fieldtype.handle + "_field",
            type: "inline",
            config: {
                type: fieldtype.handle,
                display: __(':title Field', {title: fieldtype.title}),
                width: 100,
            },
            fieldtype: fieldtype.handle,
            icon: fieldtype.icon,
            _id: `main-${sectionIndex}-${newId}`
        };

        // Add to the correct section's fields array
        this.blueprint.tabs[0].sections[sectionIndex].fields.push(newData);
        this.$toast.success(__('Field added'));
      },
      slugify(text) {
        return text.toString().toLowerCase()
          .replace(/\s+/g, '_')           // Replace spaces with _
          .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
          .replace(/\-\-+/g, '_')         // Replace multiple - with single _
          .replace(/^-+/, '')             // Trim - from start of text
          .replace(/-+$/, '');            // Trim - from end of text
      },
      deleteSection(sectionIndex) {
        this.blueprint.tabs[0].sections.splice(sectionIndex, 1);
        this.sections = [...this.blueprint.tabs[0].sections];
        this.$toast.success(__('Section deleted'));
      },
      makeSectionsSortable() {
        if (this.sortableSections) this.sortableSections.destroy();
        
        this.sortableSections = new Sortable(this.$el.querySelector('.sortable-sections'), {
          draggable: '.sortable-section',
          handle: '.sortable-section-handle',
          mirror: { constrainDimensions: true, appendTo: 'body' },
          animation: 150,
        }).on('sortable:stop', e => this.sectionHasBeenDropped(e));
      },
      sectionHasBeenDropped(e) {
        const movedSection = this.sections[e.oldIndex];
        let newSections = this.sections.filter((_, index) => index !== e.oldIndex);
        newSections.splice(e.newIndex, 0, movedSection);
        this.sections = [];
        this.$nextTick(() => {
          // Update all field IDs to match their new section positions
          newSections.forEach((section, sectionIndex) => {
            if (section.fields) {
              section.fields.forEach((field, fieldIndex) => {
                field._id = `main-${sectionIndex}-${fieldIndex}`;
              });
            }
          });
          
          this.$set(this.blueprint.tabs[0], 'sections', newSections);
          this.sections = newSections;
          this.$nextTick(() => {
            this.makeFieldsSortable();
            this.makeSectionsSortable();
          });
        });
      },
      saveSection() {
        // if (!this.newSection.display.trim()) {
        //   this.$toast.error(__('Section name cannot be empty'));
        //   return;
        // }

        if (this.isAddingNewSection) {
          // Add new section
          const newSection = {
            display: this.newSection.display,
            handle: `section_${this.slugify(this.newSection.display)}_${Date.now()}`,
            fields: []
          };
          
          this.blueprint.tabs[0].sections.push(newSection);
          this.sections = [...this.blueprint.tabs[0].sections];
          
          this.$nextTick(() => this.makeFieldsSortable());
          this.$toast.success(__('Section added'));
        } else {
          // Update existing section
          this.blueprint.tabs[0].sections[this.editingSectionIndex].display = this.newSection.display;
          
          this.$toast.success(__('Section updated'));
        }
        
        // Reset the modal state
        this.isEditingSection = false;
        this.currentSection = null;
        this.editingSectionIndex = null;
        this.newSection.display = '';
        this.isAddingNewSection = false;
      },
    }
  }

  </script>
  