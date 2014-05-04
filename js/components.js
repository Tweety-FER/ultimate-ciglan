// The Grid component allows an element to be located
//  on a grid of tiles
Crafty.c('Grid', {
    init: function() {
        this.attr({
            w: Game.grid.t.w,
            h: Game.grid.t.h
        })
    },

    // Locate this entity at the given position on the grid
    at: function(x, y) {
        if (x === undefined && y === undefined) {
            return { x: this.x/Game.grid.t.w, y: this.y/Game.grid.t.h }
        } else {
            this.attr({ x: x * Game.grid.t.w, y: y * Game.grid.t.h });
            return this;
        }
    }
});

Crafty.c("Actor", {
    init: function() {
        this.requires('2D, Canvas, Grid');
    }
})

/*  spr_blank: [0,0],
    spr_brick: [1,0],
    spr_brickMoss: [2,0],
    spr_grass: [3,0],
    spr_door: [0,1],
    spr_doorLocked: [1,1],
    spr_key: [2,1],
    spr_stone: [3,1],
    spr_stoneMoss: [0,2],
    spr_stoneBreak: [1,2],
    spr_spikeUp: [0,3],
    spr_spikeRight: [1,3],
    spr_spikeDown: [2,3],
    spr_spikeLeft: [3,3]
    */
Crafty.c('Brick', {
    init: function() {
        this.requires('Actor, Solid, spr_brick');
    },
});
Crafty.c('BrickMoss', {
    init: function() {
        this.requires('Actor, Solid, spr_brickMoss');
    },
});
Crafty.c('Grass', {
    init: function() {
        this.requires('Actor, spr_grass');
    },
});
Crafty.c('Stone', {
    init: function() {
        this.requires('Actor, Solid, spr_stone');
    },
});
Crafty.c('StoneMoss', {
    init: function() {
        this.requires('Actor, spr_stoneMoss');
    },
});

//special blocks
Crafty.c('Door', {
    init: function() {
        this.requires('Actor, spr_doorLocked');
        this.bind("HasKey", function(data) {
            this.toggleComponent("spr_doorLocked","spr_door");
        });
    },
});
Crafty.c('Key', {
    init: function() {
        this.requires('Actor, spr_key');
    },
});
Crafty.c('StoneBreak', {
    init: function() {
        this.requires('Actor, Solid, spr_stoneBreak, SpriteAnimation').reel('ani_break', 300, 1, 2, 3);
    },
    bre: function() {
        this.animate("ani_break");
        this.bind("AnimationEnd", function(data){
            this.destroy();
        })
    }
});

Crafty.c("Spiky", {
    init: function(){
    }
});

Crafty.c('Spike', {
    init: function() {
        this.requires('Actor, spr_spikeUp, Spiky');
    },
    rot: function(rotation){
        if(rotation == "up"){
            this.requires('Actor, spr_spikeUp, Spiky');
        } else {
            if(rotation == "left"){
                this.requires('Actor, spr_spikeLeft, Spiky');
            } else {
                if(rotation == "down"){
                    this.requires('Actor, spr_spikeDown, Spiky');
                } else {
                    if(rotation == "right"){
                        this.requires('Actor, spr_spikeRight, Spiky');
                    }
                }
            }
        }
        return this;
    }
});

//player
Crafty.c("Player", {
    isJumping: false,
    init: function(){
        this.requires("Actor, spr_player, Fourway, Collision, SpriteAnimation, Tween")
            .fourway(2)
            .onHit("Key", this.pickedKey)
            .onHit("Spiky", this.killed)
            .reel('ani_playerLeft', 600, 0,1,1)
            .reel('ani_playerRight', 600, 0,0,1)
            .reel('ani_playerWalkLeft', 600, 0,1,4)
            .reel('ani_playerWalkRight', 600, 0,0,4)
            .reel('ani_playerJumpLeft', 600, 1,2,1)
            .reel('ani_playerJumpRight', 600, 0,2,1)
            .reel('ani_playerDie',600, 0,3,4);
        this.bind("PlayerMove",this.moving);
    },
    pickedKey: function(data){
        key = data[0].obj;
        key.destroy();
        Crafty.trigger("HasKey", "data");
    },
    moving: function(data) {
        switch(data){
            case 0:
                break;
            case 1:
                this.animate("ani_playerWalkLeft",2);
                this.tween({x: this.x-Game.grid.t.w,y: this.y},1000)
                break;
            case 2:
                this.animate("ani_playerWalkRight",2);
                this.tween({x: this.x+Game.grid.t.w,y: this.y},1000)
                break;
            case 3:
                break;
            case 4:
                break;
        }
    },
    killed: function(data) {
        spike = data[0].obj;
        spike.removeComponent("Spiky");
        this.animate("ani_playerDie");
    },
})