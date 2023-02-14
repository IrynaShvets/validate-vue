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
          <div class="col-md-10 position-relative">
            <input
              type="text"
              class="form-control"
              id="title"
              name="title"
              v-model="getFormFields.title"
              minlength="3"
              maxlength="255"
              :rules="titleRules"
              :class="!isValid && 'input--error'"
    />
    <span v-if="!isValid" class="input__error">{{ error }}</span>
            <div class="invalid-feedback"></div>
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
              maxlength="500"
            ></textarea>

            <div class="invalid-feedback"></div>
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
              maxlength="30000"
              v-model="getFormFields.content"
            ></textarea>
            <div class="invalid-feedback">
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
              
            />
            <div class="invalid-feedback"></div>
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
            />
            <div class="invalid-feedback">
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
              <option value="1" selected>Спорт</option>
              <option value="2">Культура</option>
              <option value="3">Политика</option>
            </select>
            <div class="invalid-feedback">
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
                Форма валидна
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
        
      },
      isValid: true,
        error: "",
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
    titleRules() {
      return [this.rules.isRequired];
    },
  },

  methods: {
    
    validate() {
      this.isValid = this.rules.every((rule) => {
        const { hasPassed, message } = rule(this.value);
        if (!hasPassed) {
          this.error = message || this.errorMessage;
        }
        return hasPassed;
      });
      return this.isValid;
    },

    send() {
      if (this.isValid === true) {
        axios.post("/validator.php", this.getFormFields).then((response) => {
          console.log(response);
          return response.data;
        });
      }
        
      }
    
  },
};
</script>

<style scoped>
.input--error {
    border-color: red;
}
.input__error {
    position: absolute;
    top: 100%;
    right: 0;
    width: 100%;
    font-size: 12px;
    color: red;
    line-height: 1.3;
}

</style>
