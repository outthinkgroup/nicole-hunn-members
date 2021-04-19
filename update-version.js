const fs = require("fs");
const FILE = "./theme-version.php";

updateThemeVersion();

async function updateThemeVersion() {
  const content = await readFileAsync(FILE);

  const regex = /[0-9]+/g;
  const newContent = content.replace(regex, new Date().getTime());

  writeFileAsync(FILE, newContent);
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
