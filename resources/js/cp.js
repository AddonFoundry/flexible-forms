import CreateForm from "./components/CreateForm.vue";
import EditForm from "./components/EditForm.vue";
import ListForms from "./components/ListForms.vue";
import SubmissionForm from "./components/SubmissionForm.vue";
import BuildForm from "./components/BuildForm.vue";

Statamic.$components.register("create-flexible-form", CreateForm); 
Statamic.$components.register("edit-flexible-form", EditForm);
Statamic.$components.register("list-flexible-forms", ListForms);
Statamic.$components.register("submissions-flexible-form", SubmissionForm);
Statamic.$components.register("build-flexible-form", BuildForm);