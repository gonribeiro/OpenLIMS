using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace LIMS.Models
{
    public class Amostra
    {
        public int Id { get; set; }
        [Required]
        public string UsuarioId { get; set; }
        public Usuario Usuario { get; set; }
        public string Observacao { get; set; } // Observações gerais da amostra caso houver
        public DateTime Create_at { get; set; }
        public DateTime Delete_at { get; set; }
        public List<Analise> Analise { get; set; }
    }
}
