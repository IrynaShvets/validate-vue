<template>
  <div class="container">
    <div class="row">
      <p><span class="error">* required field</span></p>
      <form
        name="myForm"
        style="width: 100%"
        method="post"
        ref="form"
        @submit.prevent="send"
      >
        <div class="form-group row">
          <label for="title" class="col-md-2 col-form-label">Заголовок</label>
          <div class="col-md-10">
            <input
              type="text"
              class="form-control"
              id="title"
              name="title"
              v-model="getFormFields.title"
              required
              min="3"
              max="255"
              title="Поле заголовок не повинно бути порожнім, не менше трьох символів, не більше ніж 255 символів"
            />
            <div class="invalid-feedback"></div>
            <span id="errorTitle" class="error">*</span>
          </div>
        </div>

        <div class="form-group row">
          <label for="annotation" class="col-md-2 col-form-label"
            >Аннотация</label
          >
          <div class="col-md-10">
            <textarea
              name="annotation"
              id="annotation"
              class="form-control"
              cols="30"
              rows="10"
              v-model="getFormFields.annotation"
              max="500"
              title="Поле анотація не повинна перевищувати 500 символів"
            ></textarea>

            <div class="invalid-feedback"></div>
            <span class="error"></span>
          </div>
        </div>

        <div class="form-group row">
          <label for="content" class="col-md-2 col-form-label"
            >Текст новости</label
          >
          <div class="col-md-10">
            <textarea
              name="content"
              id="content"
              class="form-control"
              cols="30"
              rows="10"
              max="30000"
              v-model="getFormFields.content"
              title="Поле контенту не повинно перевищувати 30 000 символів"
            ></textarea>
            <div class="invalid-feedback">
              <span class="error"></span>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="email" class="col-md-2 col-form-label"
            >Email автора для связи</label
          >
          <div class="col-md-10">
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              v-model="getFormFields.email"
              required
              :rules="emailRules"
              pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$"
              title="Поле emai має бути валідним email і не повинно бути порожнім"
            />
            <div class="invalid-feedback"></div>
            <span class="error">*</span>
          </div>
        </div>

        <div class="form-group row">
          <label for="views" class="col-md-2 col-form-label"
            >Кол-во просмотров</label
          >
          <div class="col-md-10">
            <input
              type="number"
              class="form-control"
              id="views"
              name="views"
              v-model="getFormFields.views"
              min="0"
              title="Кількість переглядів має бути числом, не повинно бути негативним і в межах розміру UNSIGNED INT"
            />
            <div class="invalid-feedback">
              <span class="error"></span>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="date" class="col-md-2 col-form-label"
            >Дата публикации</label
          >
          <div class="col-md-10">
            <input
              type="date"
              class="form-control"
              id="date"
              name="date"
              v-model="getFormFields.date"
              min=""
              step="1"
            />
            <div class="invalid-feedback">
              <span class="error"></span>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="is_publish" class="col-md-2 col-form-label"
            >Публичная новость</label
          >
          <div class="col-md-10">
            <input
              type="checkbox"
              class="form-control"
              id="is_publish"
              name="is_publish"
              v-model="getFormFields.is_publish"
            />
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 col-form-label">Публиковать на главной</label>
          <div class="col-md-10">
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="publish_in_index"
                v-model="getFormFields.publish_in_index"
                required
                id="publish_in_index_yes"
                value="yes"
                checked
              />
              <label class="form-check-label" for="publish_in_index_yes">
                Да
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="publish_in_index"
                v-model="getFormFields.publish_in_index"
                required
                id="publish_in_index_no"
                value="no"
              />
              <label class="form-check-label" for="publish_in_index_no">
                Нет
              </label>
            </div>
            <div class="invalid-feedback"></div>
            <span class="error">*</span>
          </div>
        </div>

        <div class="form-group row">
          <label for="category" class="col-md-2 col-form-label"
            >Публичная новость</label
          >
          <div class="col-md-10">
            <select
              id="category"
              class="form-control"
              name="category"
              v-model="getFormFields.category"
            >
              <option disabled selected>Выберете категорию из списка..</option>
              <option value="1">Спорт</option>
              <option value="2">Культура</option>
              <option value="3">Политика</option>
            </select>
            <div class="invalid-feedback">
              <span class="error"></span>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-9">
            <button type="submit" name="submit" class="btn btn-primary">
              Отправить
            </button>
          </div>
          <div class="col-md-3">
            <div class="alert alert-success">
              <button
                type="button"
                name="validate"
                @click="validateForm"
                class="btn btn-primary"
              >
                Форма валидна
              </button>
              <!-- <a href="" class="btn btn-primary">Форма валидна</a> -->
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "../utils/axios.js";
import { emailValidation, isRequired } from "../utils/validationRules.js";

export default {
  name: "FormApp",

  data() {
    return {
      getFormFields: {
        title: "",
        annotation: "",
        content: "",
        email: "",
        views: "",
        date: "",
        is_publish: "",
        publish_in_index: "",
        category: "",
        isValid: false,
        errors: "",
      },
    };
  },

  computed: {
    rules() {
      return {
        emailValidation,
        isRequired,
      };
    },
    emailRules() {
      return [this.rules.emailValidation, this.rules.isRequired];
    },
  },

  methods: {
    send() {
    //   if (this.isValid === true) {
        axios.post("/", this.getFormFields).then((response) => {
          console.log(response);
          return response.data;
        });
    //   }
    },

    validateForm() {
      const { form } = this.$refs;
      const isFormValid = form.validate();

      if (isFormValid) {
        this.isValid = true;
      }
      this.isValid = false;
    },
  },
};
</script>

<style scoped></style>
