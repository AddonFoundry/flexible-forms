<template>

  <publish-container
      v-if="blueprint"
      ref="container"
      name="collection"
      reference="collection"
      :blueprint="blueprint"
      :values="values"
      :meta="meta"
      :errors="errors"
      :site="site"
      @updated="values = $event"
  >
      <div slot-scope="{ setFieldValue, setFieldMeta }">
        <header class="mb-6">
              <!--<breadcrumb :url="url" :title="values.title" />-->
              <div class="flex items-center">
                  <h1 class="flex-1" v-text="__('Form Settings')" />
                  <button type="submit" class="btn-primary" @click="submit">{{ __('Save') }}</button>
              </div>
          </header>
      
          <section class="card inline-flex mt-5 mb-4 p-0 rounded-md px-1">
            <a :href="pageUrl + '/build'" class="inline-flex items-center py-3 px-4 text-sm font-semibold rounded-md">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.33333 2H3C2.44772 2 2 2.44772 2 3V13C2 13.5523 2.44772 14 3 14H13C13.5523 14 14 13.5523 14 13V8.35294" stroke="black" stroke-linecap="round"></path><path d="M8.067 10.1593L13.8605 4.36403C13.946 4.27851 14 4.15248 14 4.02195C14 3.90742 13.9585 3.7889 13.86 3.69088L12.3025 2.13853C12.21 2.04601 12.088 2 11.9665 2C11.845 2 11.7235 2.04601 11.6305 2.13853L5.8275 7.92282C5.543 8.80451 5.05 10.3349 5.0145 10.4639C5.0045 10.5014 5 10.5389 5 10.5759C5 10.8065 5.1745 11 5.3825 11C5.638 11 5.878 10.9055 8.067 10.1593ZM6.432 8.48794L7.5005 9.55668L5.9165 10.0798L6.432 8.48794ZM6.9095 7.90481L11.9665 2.86419L13.134 4.02795L8.0845 9.07957L6.9095 7.90481Z" fill="black"></path></svg>
              <span class="ml-2">Form Builder</span>
            </a>
            <a :href="pageUrl + '/submissions'" class="inline-flex items-center py-3 px-4 text-sm font-semibold rounded-md">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 13L10 13" stroke="black" stroke-linecap="round"></path><path d="M2 9.66663L14 9.66663" stroke="black" stroke-linecap="round"></path><path d="M2 6.33337L14 6.33338" stroke="black" stroke-linecap="round"></path><path d="M2 3L14 3" stroke="black" stroke-linecap="round"></path></svg>
              <span class="ml-2">Submissions</span>
            </a>
            <span class="inline-flex items-center py-3 px-4 text-sm font-semibold rounded-md opacity-50">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 6.05517C6.92783 6.05517 6.05575 6.92783 6.05575 8C6.05575 9.07217 6.92783 9.94425 8 9.94425C9.07217 9.94425 9.94425 9.07217 9.94425 8C9.94425 6.92783 9.07217 6.05517 8 6.05517ZM8 10.5276C6.60583 10.5276 5.47242 9.39417 5.47242 8C5.47242 6.60583 6.60583 5.47183 8 5.47183C9.39417 5.47183 10.5276 6.60583 10.5276 8C10.5276 9.39417 9.39417 10.5276 8 10.5276ZM7.30408 14.4167H8.69592C8.917 13.7727 9.08558 12.9869 9.925 12.6375C10.7977 12.2776 11.4802 12.7518 12.0454 13.0295L13.0289 12.0448C12.7326 11.4341 12.2904 10.7621 12.6387 9.92092C12.9694 9.12233 13.6531 8.95083 14.4167 8.6965V7.3035C13.6962 7.05792 12.9752 6.8905 12.6392 6.07967C12.3056 5.27467 12.6725 4.68258 13.0295 3.95458L12.0454 2.97108C11.3938 3.29017 10.7498 3.70433 9.92092 3.36075C9.11942 3.02767 8.95492 2.34925 8.69592 1.58333H7.30408C7.05675 2.30142 6.89342 3.023 6.07967 3.36017C5.86675 3.44942 5.66083 3.492 5.45142 3.492C4.95967 3.492 4.55367 3.26333 3.95458 2.97108L2.9705 3.95458C3.30533 4.64 3.70025 5.2595 3.36075 6.07967C3.02767 6.88175 2.34925 7.0445 1.58333 7.3035V8.6965C2.2985 8.94033 3.023 9.10775 3.36075 9.92033C3.69967 10.7387 3.317 11.339 2.9705 12.0454L3.95458 13.0295C4.80042 12.6066 5.32833 12.3272 6.07908 12.6392C6.88292 12.9729 7.0445 13.6531 7.30408 14.4167ZM9.10892 15H6.8905C6.49325 13.8812 6.43258 13.4174 5.85625 13.1783C5.27 12.9338 4.8465 13.2552 3.83442 13.7336L2.26583 12.165C2.77508 11.0934 3.06325 10.7271 2.82175 10.1437C2.58142 9.56567 2.12642 9.50967 1 9.1095V6.8905C2.11183 6.495 2.582 6.43433 2.82175 5.85625C3.0615 5.27817 2.78033 4.91533 2.26583 3.83442L3.83442 2.26642C4.85 2.74942 5.27292 3.06267 5.85567 2.82233C6.43433 2.582 6.48683 2.13108 6.89108 1H9.10892C9.50675 2.11883 9.56858 2.58317 10.1437 2.82175C10.7277 3.06442 11.1407 2.75233 12.1662 2.26642L13.7336 3.83442C13.2214 4.91183 12.9397 5.27933 13.1783 5.85567C13.418 6.43433 13.8736 6.48975 15 6.8905V9.11008C13.8882 9.505 13.4174 9.56625 13.1777 10.1443C12.9426 10.7131 13.2033 11.0549 13.7342 12.165L12.1662 13.7336C11.1582 13.2552 10.7271 12.9344 10.1502 13.1765C9.57383 13.4157 9.52017 13.845 9.10892 15Z" fill="black"></path></svg>
              <span class="ml-2">Form Settings</span>
            </span>
            
          </section>


          <configure-tabs
              @updated="setFieldValue"
              @meta-updated="setFieldMeta"
              :enable-sidebar="false"/>
      </div>
    </publish-container>

</template>

<script>
export default {

  props: {
      blueprint: Object,
      editTitle: String,
      initialValues: Object,
      meta: Object,
      url: String
  },

  data() {
      return {
          values: this.initialValues,
          error: null,
          errors: {},
          pageUrl: '',
      }
  },

  methods: {

      clearErrors() {
          this.error = null;
          this.errors = {};
      },

      submit() {
          this.saving = true;
          this.clearErrors();

          this.$axios.patch(this.url, this.values).then(response => {
              this.saving = false;
              this.$toast.success(__('Saved'));
              this.$refs.container.saved();
          }).catch(e => this.handleAxiosError(e));
      },

      handleAxiosError(e) {
          this.saving = false;
          if (e.response && e.response.status === 422) {
              const { message, errors } = e.response.data;
              this.error = message;
              this.errors = errors;
              this.$toast.error(message);
          } else {
              this.$toast.error(__('Something went wrong'));
          }
      },

  },

  created() {
      this.$keys.bindGlobal(['mod+s'], e => {
          e.preventDefault();
          this.submit();
      });

      this.pageUrl = window.location.href.replace(/\/[^/]*$/, '');

  },

  computed: {
      site() {
          return this.$config.get('selectedSite');
      }
  }

}
</script>

<style>
.publish-field__blueprint {
  display: none !important;
}
</style>