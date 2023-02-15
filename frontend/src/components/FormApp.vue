<template>
  <div class="container">
    <div class="row">
      <form
        style="width: 100%"
       
        @submit.prevent="send"
      >
        <div
          class="form-group row"
          :class="{ error: v$.form.title.$errors.length }"
        >
          <label for="title" class="col-md-2 col-form-label">Заголовок</label>
          <div class="col-md-10 position-relative">
            <input
              type="text"
              class="form-control"
              id="title"
              name="title"
              v-model="v$.form.title.$model"
            />
            <div class="invalid-feedback"></div>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.title.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.annotation.$errors.length }"
        >
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
              v-model="v$.form.annotation.$model"
            ></textarea>

            <div class="invalid-feedback"></div>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.annotation.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.content.$errors.length }"
        >
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
              v-model="v$.form.content.$model"
            ></textarea>
            <div class="invalid-feedback"></div>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.content.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.email.$errors.length }"
        >
          <label for="email" class="col-md-2 col-form-label"
            >Email автора для связи</label
          >
          <div class="col-md-10">
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              v-model="v$.form.email.$model"
            />
            <div class="invalid-feedback"></div>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.email.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.views.$errors.length }"
        >
          <label for="views" class="col-md-2 col-form-label"
            >Кол-во просмотров</label
          >
          <div class="col-md-10">
            <input
              type="number"
              class="form-control"
              id="views"
              name="views"
              v-model="v$.form.views.$model"
            />
            <div class="invalid-feedback"></div>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.views.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
         
        >
          <label for="date" class="col-md-2 col-form-label"
            >Дата публикации</label
          >
          <div class="col-md-10">
            <input
              type="date"
              class="form-control"
              id="date"
              name="date"
              v-model="form.date"
            />
            <div class="invalid-feedback"></div>
            
          </div>
        </div>

        <div
          class="form-group row"
        >
          <label for="is_publish" class="col-md-2 col-form-label"
            >Публичная новость</label
          >
          <div class="col-md-10">
            <input
              type="checkbox"
              class="form-control"
              id="is_publish"
              name="is_publish"
              v-model="form.is_publish"
            />
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.publish_in_index.$errors.length }"
        >
          <label class="col-md-2 col-form-label">Публиковать на главной</label>
          <div class="col-md-10">
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="publish_in_index"
                v-model="v$.form.publish_in_index.$model"
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
                v-model="v$.form.publish_in_index.$model"
                required
                id="publish_in_index_no"
                value="no"
              />
              <label class="form-check-label" for="publish_in_index_no">
                Нет
              </label>
            </div>
            <div class="invalid-feedback"></div>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.views.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
        >
          <label for="category" class="col-md-2 col-form-label"
            >Публичная новость</label
          >
          <div class="col-md-10">
            <select
              id="category"
              class="form-control"
              name="category"
              v-model="form.category"
            >
              <option value="1" selected>Спорт</option>
              <option value="2">Культура</option>
              <option value="3">Политика</option>
            </select>
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-9">
            <button type="submit" name="submit" class="btn btn-primary">
              Отправить
            </button>
          </div>
          <div class="col-md-3">
            <div class="alert alert-success">Форма валидна</div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import {axiosInstance} from "../utils/axios.js";
import useVuelidate from "@vuelidate/core";
import { required, email, minLength, maxLength, integer } from "@vuelidate/validators";

export default {
  name: "FormApp",
  setup() {
    return { v$: useVuelidate() };
  },

  data() {
    return {
      form: {
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
    };
  },

  validations() {
      return {
        form: {
          title: {
            required,
            min: minLength(3),
            max: maxLength(255),
          },
          annotation: {
            max: maxLength(500),
          },
          content: {
            max: maxLength(30000),
          },
          email: {
            required,
            email,
          },
          views: {
            integer,
            min: minLength(0),
            max: maxLength(2147483647),
          },
          // date: {
          //   maxValue: maxValue(new Date()),
          // },
          publish_in_index: {
            required,
          },
        },
      };
    },

    validationConfig: {
    $lazy: true,
  },

  methods: {
    
  async send() {
      const isFormCorrect = this.v$.$validate();
      if (!isFormCorrect) return;

      try {
        const { data } = await axiosInstance.post("/validator.php", this.getFormFields)
        console.log(data);
        return data;
      } catch (error) {
        console.error(error);
      }
      
    },

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
