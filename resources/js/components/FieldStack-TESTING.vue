<template>
	<stack name="inline-editor" v-if="isEditing" @closed="editorClosed()" half>
		<div class="h-full bg-gray-300 overflow-scroll">

      <publish-form

      title="My Form"
      :blueprint='blueprint'
      :meta='blueprint'
      :values='currentField'

      >

      </publish-form>

		</div>
	</stack>
</template>



<script>


export default {

  data() {
      return {
          //isEditing: false,
        }
  },
  props: ['blueprint', 'currentField', 'isEditing'],
  mixins: [Fieldtype],
  created() {
    //this.fields = this.blueprint.tabs[0].sections[0].fields;
  },

  methods: {

      applyChanges() {
        this.$events.$emit('event.close-stack');
      },

      editorClosed() {
          this.$events.$emit('event.close-stack');
      },

      commit() {
          //this.clearErrors();

          this.$axios.post(cp_url('fields/update'), {
              id: this.id,
              type: this.type,
              values: this.values,
              fields: this.fields
          }).then(response => {
              this.$emit('committed', response.data, this.editedFields);
              this.close();
          }).catch(e => this.handleAxiosError(e));
      },

  }

}
</script>