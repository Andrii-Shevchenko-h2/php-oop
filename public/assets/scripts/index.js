const dots = [];
const mouse = {
  x: 0,
  y: 0
};

const Dot = function() {
  this.x = 0;
  this.y = 0;
  this.node = (function(){
    const n = document.createElement("div");
    n.className = "trail";
    document.body.appendChild(n);
    return n;
  }());
};

Dot.prototype.draw = function() {
  this.node.style.left = this.x + "px";
  this.node.style.top = this.y + "px";
};

for (let i = 0; i < 12; i++) {
  const d = new Dot();
  dots.push(d);
}

function draw() {
  let x = mouse.x;
  let y = mouse.y;

  dots.forEach(function(dot, index, dots) {
    const nextDot = dots[index + 1] || dots[0];

    dot.x = x;
    dot.y = y;
    dot.draw();
    x += (nextDot.x - dot.x) * .6;
    y += (nextDot.y - dot.y) * .6;
  });
}

addEventListener("mousemove", function(event) {
  mouse.x = event.pageX;
  mouse.y = event.pageY;
});

function animate() {
  draw();
  requestAnimationFrame(animate);
};

animate();
