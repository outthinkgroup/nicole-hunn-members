const fs = require("fs");
const FILE = "./theme-version.php";

updateThemeVersion();

async function updateThemeVersion() {
  const content = await readFileAsync(FILE);

  const regex = /[0-9]+/g;
  const newContent = content.replace(regex, updater);

  writeFileAsync(FILE, newContent);
}
//increments the version by 1
function updater() {
  return "xxxxxyxx-xyxx".replace(/[xy]/g, function (c) {
    var r = (Math.random() * 16) | 0,
      v = c === "x" ? r : (r & 0x3) | 0x8;
    return v.toString(16);
  });
}

function readFileAsync(path) {
  return new Promise((resolve, reject) => {
    fs.readFile(path, (e, data) => {
      if (e) {
        reject(e);
      } else {
        resolve(data);
      }
    });
  }).then((res) => res.toString());
}
async function writeFileAsync(path, data) {
  return new Promise((resolve, reject) => {
    fs.writeFile(path, data, "utf8", (e, data) => {
      if (e) {
        reject(e);
      } else {
        resolve(data);
      }
    });
  });
}
