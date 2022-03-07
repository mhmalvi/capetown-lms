import axios from "axios";

export default () => {
  const all = (per_page, search) => {
    return axios.get("course");
  };

  const getWithUnits = (id, role = "admin") => {
    if (role == "admin") role = "";
    return axios.get(role + `/course/${id}/units`);
  };

  // this is for students
  const getCompletedUnits = (course_id) => {
    return axios.get(`student/course/${course_id}/units/completed`);
  };

  return {
    all,
    getWithUnits,
    getCompletedUnits,
  };
};
