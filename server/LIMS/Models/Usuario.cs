using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace LIMS.Models
{
    public class Usuario
    {
        public int Id { get; set; }
        [Required]
        public string Nome { get; set; } // Nome Completo
        [Required]
        public string Conta { get; set; }
        [Required]
        public string Senha { get; set; }
        public DateTime Delete_at { get; set; }
    }
}
